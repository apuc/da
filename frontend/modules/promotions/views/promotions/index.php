<?php
use common\models\User;

$this->title = "Акции - DA Info";
//\common\classes\Debug::prn($stock);
$this->registerJsFile('/js/stock.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<section class="business">

    <div class="container">

        <div class="business__wrapper">
            <h3 class="business__title">Акции</h3>
            <div class="stock__content business__single-content">
                <?php
                $k = 1;
                foreach ($stock as $item):  ?>
                    <?php if(in_array($k, $placeStock)):?>
                        <div class="stock__big-item stockBlock" data-id="<?= $item->id; ?>">
                            <div class="stock__sm-item--header">
                                <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $item['company']->slug] ); ?>" class="title"><?= $item['company']->name ?></a>
                                <a href="#" class="like likes <?= User::hasLike('stock', $item->id) ? 'active' : '' ?>"
                                   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                   data-id="<?= $item->id; ?>"
                                   data-type="stock">
                                    <i class="like-set-icon"></i>
                                    <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                </a>
                                <?php
                                if($item->recommended == 1 ):
                                    ?>
                                    <div class="recommend">
                                        <span class="recommend__star"></span>
                                        Рекомендуем
                                    </div>
                                <?php endif; ?>
                            </div>
                            <a href="<?= (!empty($item->link)) ? $item->link : \yii\helpers\Url::to(['/promotions/promotions/view', 'slug' => $item->slug]) ?>"  class="stock__sm-item--img stockView">
                                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item->photo); ?>" alt="">
                            </a>
                            <a href="<?= (!empty($item->link)) ? $item->link : \yii\helpers\Url::to(['/promotions/promotions/view', 'slug' => $item->slug]) ?>"  class="stock__sm-item--descr stockView">
                                <p><?= $item->title ?></p>
                                <span class="views"><?= $item->view; ?></span>
                            </a>
                            <a href="<?= (!empty($item->link)) ? $item->link : \yii\helpers\Url::to(['/promotions/promotions/view', 'slug' => $item->slug]) ?>"  class="stock__sm-item--time stockView">
                                <p><?= $item->dt_event ?></p>
                            </a>
                        </div>
                    <?php else:?>
                        <div class="stock__sm-item stockBlock" data-id="<?= $item->id; ?>">

                            <div class="stock__sm-item--header">
                                <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $item['company']->slug] ); ?>" class="title"><?= $item['company']->name ?></a>
                                <a href="#" class="like likes <?= User::hasLike('stock', $item->id) ? 'active' : '' ?>"
                                   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                   data-id="<?= $item->id; ?>"
                                   data-type="stock">
                                    <i class="like-set-icon"></i>
                                    <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                </a>
                                <?php
                                if($item->recommended == 1 ):
                                    ?>
                                    <div class="recommend">
                                        <span class="recommend__star"></span>
                                        Рекомендуем
                                    </div>
                                <?php endif; ?>
                            </div>
                            <a href="<?= (!empty($item->link)) ? $item->link : \yii\helpers\Url::to(['/promotions/promotions/view', 'slug' => $item->slug]) ?>" class="stock__sm-item--img stockView">
                                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item->photo); ?>" alt="">
                            </a>
                            <a href="<?= (!empty($item->link)) ? $item->link : \yii\helpers\Url::to(['/promotions/promotions/view', 'slug' => $item->slug]) ?>" class="stock__sm-item--descr stockView">
                                <p><?= $item->title ?></p>
                                <span class="views"><?= $item->view; ?></span>
                            </a>
                            <a href="<?= (!empty($item->link)) ? $item->link : \yii\helpers\Url::to(['/promotions/promotions/view', 'slug' => $item->slug]) ?>"  class="stock__sm-item--time stockView">
                                <p><?= $item->dt_event ?></p>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php $k++; endforeach; ?>

                <div class="news__wrap_buttons">
                    <a href=""
                       data-page="1"
                       class="show-more show-more-stock">загрузить БОЛЬШЕ</a>
                </div>

            </div>

            <?= \frontend\widgets\ShowRightRecommend::widget(); ?>

        </div>

    </div>

</section>
