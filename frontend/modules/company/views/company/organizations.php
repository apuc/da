<?php
/**
 * Created by PhpStorm.
 * User: waryataw
 * Date: 15.10.2016
 * Time: 21:25
 * @var $organizations CategoryCompany
 */
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use yii\helpers\Url;
//\common\classes\Debug::prn($organizations);
?>

<?php foreach($organizations as $organization): ?>

        <a href="<?= Url::to(['/company/default/view', 'slug'=>$organization->slug]) ?>" class="category-items-item">
        <div class="thumb">
            <img src="<?= $organization->photo ?>" alt="">
        </div>
        <div class="info">
            <h2><?=$organization->name ; ?></h2>
            <p><?=$organization->address ; ?></p>
        </div>
        <div class="contacts">
            <span><?= $organization->phone; ?></span>
        </div>
    </a>
    
<?php endforeach; ?>

