<?php

use yii\helpers\Url;
//\common\classes\Debug::prn($categoryId);
//\common\classes\Debug::dd($categoryTreeArr);





?>
<aside class="shop__sidebars">
    <a href="#" class="mobile-menu-broad-close">
        <i class="fa fa-times" aria-hidden="true"></i>
    </a>

    <?php

    foreach ($categoryTreeArr[$categoryId] as $item): ?>
        <div class="shop__sidebars--wrap">

            <?php
            if(isset($categoryTreeArr[0][$categoryId]) && $categoryTreeArr[0][$categoryId]->parent_id == 0){
                $urlCategory = $categoryTreeArr[0][$categoryId]->slug;
            }
            else{
                // /elektronika/telefony-i-aksessuary-k-nim/mobilnye-telefony
                $urlCategory = $ollCategory[$ollCategory[$item->parent_id]->parent_id]->slug . '/' . $ollCategory[$item->parent_id]->slug;
               // \common\classes\Debug::dd();
            }
//\common\classes\Debug::dd(Url::to(['/shop/shop/category', 'category' => [$urlCategory, $item->slug]]));
            ?>
            <a href="<?= Url::to(['/shop/shop/category', 'category' => [$urlCategory, $item->slug]]) ?>">
                <h4 class="shop__sidebars-title"><?= $item->name; ?></h4>
            </a>
            <?php //\common\classes\Debug::prn($item); ?>
            <?php if(isset($categoryTreeArr[$item->id])):?>
                <ul class="shop__nav">
                <?php foreach($categoryTreeArr[$item->id] as $value): ?>

                        <li><a href="#"><?= $value->name; ?></a></li>



                <?php endforeach; ?>
                    <!-- <li  class="broad-more">
                            <ul class="shop-hidden">
                                <li><a href="#">Холодильники, морозильники, винные шкафы</a></li>
                                <li><a href="#">Посудомоечные машины</a></li>
                                <li><a href="#">Плиты</a></li>
                                <li><a href="#">Вытяжки</a></li>
                                <li><a href="#">Подогреватели посуды</a></li>
                            </ul>
                            <a href="#" class="slide-text">eщё</a>
                        </li>-->
                </ul>
            <?php endif; ?>
    </div>
    <?php endforeach; ?>
</aside>