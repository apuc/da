<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.10.2016
 * Time: 11:31
 * @var $category \common\models\db\CategoryPoster
 */
use yii\helpers\Url;

?>
<div class="posters">
    <div class="shape">
        <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
    </div>
    <div class="posters-categories">
        <ul class="posters-categories-list">
            <?php foreach ($category as $item): ?>
                <li><a href="<?= Url::to(['/poster/default/single_category', 'slug'=>$item->slug]) ?>"><?= $item->title ?>
                        <!--<span>90</span>-->
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="clearfix"></div>
        <div class="shape">
            <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
        </div>
        <!--<ul class="posters-month">
            <li class="active"><a href="#">Январь<span>222</span></a></li>
            <li><a href="#">Февраль<span>80</span></a></li>
            <li><a href="#">Март<span>79</span></a></li>
            <li><a href="#">Апрель<span>79</span></a></li>
            <li><a href="#">Май<span>78</span></a></li>
            <li><a href="#">Июнь<span>77</span></a></li>
            <li><a href="#">Июль<span>76</span></a></li>
            <li><a href="#">Август<span>75</span></a></li>
            <li><a href="#">Сентябрь<span>9</span></a></li>
            <li><a href="#">Октябрь<span>6</span></a></li>
            <li><a href="#">Ноябрь<span>1</span></a></li>
            <li><a href="#">Декабрь<span>5</span></a></li>
        </ul>
        <a class="categories-clear-option" href="#">Очистить параметры</a>-->
    </div>
    <div class="posters-posts content__main afisha__right">
        <div class="afisha__right">
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
            <a href="" class="afisha__right_item">
                <span class="afisha-date-small"><b>20</b> сен</span>
                <img src="img/small-afisha.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="banner-bottom">
        <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">
    </div>
</div>