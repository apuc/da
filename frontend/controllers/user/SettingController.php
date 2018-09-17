<?php
/**
 * Created by PhpStorm.
 * User: Офис
 * Date: 14.07.2016
 * Time: 12:47
 */

namespace frontend\controllers\user;



use common\classes\Debug;
//use common\models\db\Profile;
use dektrium\user\controllers\SettingsController;

use frontend\models\user\Profile;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\imagine\Image;

class SettingController extends SettingsController
{
    /**
     * Shows profile settings form.
     *
     * @return string|\yii\web\Response
     */
    public function actionProfile()
    {
        //$this->layout = 'personal_area';
        $model = $this->finder->findProfileById(Yii::$app->user->identity->getId());

        if ($model == null) {
            $model = Yii::createObject(Profile::className());
            $model->link('user', Yii::$app->user->identity);
        }

        $event = $this->getProfileEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);
        //Debug::prn($model->validate());
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //Debug::prn($_POST);
            if(!empty($_FILES['Profile']['tmp_name']['avatar'])) {

                if (!file_exists('media/users/' . Yii::$app->user->id)) {
                    mkdir('media/users/' . Yii::$app->user->id . '/');
                }
                $dir = 'media/users/' . Yii::$app->user->id . '/';

                $extension = strtolower(substr(strrchr($_FILES['Profile']['name']['avatar'], '.'), 1));


                Image::thumbnail($_FILES['Profile']['tmp_name']['avatar'], 160, 160, $mode = \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND)
                    ->save($dir . 'avatar.' . $extension, ['quality' => 100]);
                Image::thumbnail($_FILES['Profile']['tmp_name']['avatar'], 31, 31, $mode = \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND)
                    ->save($dir . 'avatar_little.' . $extension, ['quality' => 100]);

                //Debug::prn($model);

                $model->avatar = '/' . $dir . 'avatar.' . $extension;
                $model->avatar_little = '/' . $dir . 'avatar_little.' . $extension;
            }
            else{
                unset($model->avatar);
            }
            $model->save();
            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
            return $this->refresh();
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

}