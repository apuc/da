<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 07.04.2017
 * Time: 15:10
 */

namespace frontend\modules\consulting\widgets;

use common\classes\Debug;
use common\models\db\CategoryFaq;
use common\models\db\CategoryPostsConsulting;
use common\models\db\CategoryPostsDigest;
use frontend\modules\consulting\models\CategoryPosts;
use yii\base\Widget;
use yii\helpers\Url;

class ConsultingPostsMenu extends Widget
{
    public $consulting;

    public function run()
    {
        $sections = [];
        $action = \Yii::$app->controller->action->id;

        if ($this->consulting->about_company) {
            $sections['О компании'] = [
                'url' => Url::to(['/consulting/consulting/view', 'slug' => $this->consulting->slug]),
                'content' => '',
                'active' => '',
            ];
        }
        if ($this->consulting->documents) {
            $sections[$this->consulting->title_digest] = [
                'url' => Url::to(['/consulting/consulting/documents', 'slug' => $this->consulting->slug]),
                'content' => $this->generateTree(CategoryPostsDigest::findAll(['type' => $this->consulting->slug])),
                'active' => ($action == 'documents') ? 'active' : '',
            ];
        }
        if ($this->consulting->posts) {
            $sections['Статьи'] = [
                'url' => Url::to(['/consulting/consulting/posts', 'slug' => $this->consulting->slug]),
                'content' => $this->generateTree(CategoryPostsConsulting::findAll(['type' => $this->consulting->slug])),
                'active' => ($action == 'posts') ? 'active' : '',
            ];
        }
        if ($this->consulting->faq) {
            $sections['Вопрос / Ответ'] = [
                'url' => Url::to(['/consulting/consulting/faq', 'slug' => $this->consulting->slug]),
                'content' => $this->generateTree(CategoryFaq::findAll(['type' => $this->consulting->slug])),
                'active' => ($action == 'faq') ? 'active' : '',
            ];
        }
        return $this->render('consulting_posts_menu', ['sections' => $sections]);
    }

    public function generateTree($tree, $parent_id = 0)
    {

        $html = '';
        foreach ($tree as $row) {
            if ($row['parent_id'] == $parent_id) {
                $html .= '<li><a href="">';
                $html .= '' . $row['title'];
                $html .= '' . '</a>';
                $html .= '' . $this->generateTree($tree, $row['id']);
                $html .= '</li>';
                $html .= '</li>';
            }
        }
        return $html ? '<ul >' . $html . '</ul>' . "\n" : '';
    }

}