<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * @var $cat \common\models\db\CategoryNews
 * @var $news_5 \common\models\db\News
 */

$this->title = Yii::t('news', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-news" style="margin-top: 30px">
    <div class="container">
        <div class="news-gallery-container">
            <?php $i = 0; ?>
            <?php foreach ($news_5 as $new): ?>
                <?php if ($i == 0): ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $new->slug]) ?>" class="big-news-gallery-item">
                        <img src="<?= $new->photo ?>" alt="">
                        <span class="news-text">
                            <h4 class="gallery-news-text-header"><?= $new->title ?></h4>
                            <p>
                                <?= $new->content ?>
                            </p>
                        </span>
                    </a>
                <?php else: ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $new->slug]) ?>" class="news-gallery-item">
                        <img src="<?= $new->photo ?>" alt="">
                        <span class="news-text">
                            <p>
                                <?= $new->title ?>
                            </p>
                        </span>
                    </a>
                <?php endif; ?>
                <?php $i++; ?>
            <?php endforeach; ?>
            <div class="shape">
                <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
            </div>
        </div>

        <div class="news-posts">
            <div class="news-posts__item">
                <span class="date-news__post">22 сен 20:16</span>
                <h4 class="category">Экономика</h4>
                <h5 class="post-header">Для расследования причин пожара на судне
                    ВМС «Донбасс» создана комиссия</h5>
                <div class="post-image">
                    <img src="/theme/portal-donbassa/img/news-post-item.jpg" alt="">
                </div>
                <p class="text-preview">Командующий Военно-морских сил ВСУ Игорь Воронченко назначил комиссию для
                    расследования причин пожара на судне </p>
                <a href="#" class="read-more">Читать дальше <img
                        src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>

                <ul class="more-news">
                    <li><a href="#">Сегодня комитет Европарламента рассмотрит вопрос
                            безвизового режима с Украиной</a></li>
                    <li><a href="#">Путин и Меркель на саммите G20 обсудили ситуацию
                            в Украине</a></li>
                    <li><a href="#">Дело об убийстве Шеремета имеет все шансы быть
                            расследуемым, — Аваков</a></li>
                </ul>
                <div class="line"></div>
            </div>
            <div class="news-posts__item">
                <span class="date-news__post">22 сен 20:16</span>
                <h4 class="category">Политика</h4>
                <h5 class="post-header">Для расследования причин пожара на судне
                    ВМС «Донбасс» создана комиссия</h5>
                <div class="post-image">
                    <img src="/theme/portal-donbassa/img/news-post-item.jpg" alt="">
                </div>
                <p class="text-preview">Командующий Военно-морских сил ВСУ Игорь Воронченко назначил комиссию для
                    расследования причин пожара на судне </p>
                <a href="#" class="read-more">Читать дальше <img
                        src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>

                <ul class="more-news">
                    <li><a href="#">Сегодня комитет Европарламента рассмотрит вопрос
                            безвизового режима с Украиной</a></li>
                    <li><a href="#">Путин и Меркель на саммите G20 обсудили ситуацию
                            в Украине</a></li>
                    <li><a href="#">Дело об убийстве Шеремета имеет все шансы быть
                            расследуемым, — Аваков</a></li>
                </ul>
                <div class="line"></div>
            </div>
            <div class="news-posts__item">
                <span class="date-news__post">22 сен 20:16</span>
                <h4 class="category">Происшествия</h4>
                <h5 class="post-header">Для расследования причин пожара на судне
                    ВМС «Донбасс» создана комиссия</h5>
                <div class="post-image">
                    <img src="/theme/portal-donbassa/img/news-post-item.jpg" alt="">
                </div>

                <p class="text-preview">Командующий Военно-морских сил ВСУ Игорь Воронченко назначил комиссию для
                    расследования причин пожара на судне </p>
                <a href="#" class="read-more">Читать дальше <img
                        src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>

                <ul class="more-news">
                    <li><a href="#">Сегодня комитет Европарламента рассмотрит вопрос
                            безвизового режима с Украиной</a></li>
                    <li><a href="#">Путин и Меркель на саммите G20 обсудили ситуацию
                            в Украине</a></li>
                    <li><a href="#">Дело об убийстве Шеремета имеет все шансы быть
                            расследуемым, — Аваков</a></li>
                </ul>
                <div class="line"></div>
            </div>
            <div class="news-posts__item">
                <span class="date-news__post">22 сен 20:16</span>
                <h4 class="category">Культура</h4>
                <h5 class="post-header">Для расследования причин пожара на судне
                    ВМС «Донбасс» создана комиссия</h5>
                <div class="post-image">
                    <img src="/theme/portal-donbassa/img/news-post-item.jpg" alt="">
                </div>

                <p class="text-preview">Командующий Военно-морских сил ВСУ Игорь Воронченко назначил комиссию для
                    расследования причин пожара на судне </p>
                <a href="#" class="read-more">Читать дальше <img
                        src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>

                <ul class="more-news">
                    <li><a href="#">Сегодня комитет Европарламента рассмотрит вопрос
                            безвизового режима с Украиной</a></li>
                    <li><a href="#">Путин и Меркель на саммите G20 обсудили ситуацию
                            в Украине</a></li>
                    <li><a href="#">Дело об убийстве Шеремета имеет все шансы быть
                            расследуемым, — Аваков</a></li>
                </ul>
                <div class="line"></div>
            </div>
            <div class="news-posts__item">
                <span class="date-news__post">22 сен 20:16</span>
                <h4 class="category">Спорт</h4>
                <h5 class="post-header">Для расследования причин пожара на судне
                    ВМС «Донбасс» создана комиссия</h5>
                <div class="post-image">
                    <img src="/theme/portal-donbassa/img/news-post-item.jpg" alt="">
                </div>

                <p class="text-preview">Командующий Военно-морских сил ВСУ Игорь Воронченко назначил комиссию для
                    расследования причин пожара на судне </p>
                <a href="#" class="read-more">Читать дальше <img
                        src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>

                <ul class="more-news">
                    <li><a href="#">Сегодня комитет Европарламента рассмотрит вопрос
                            безвизового режима с Украиной</a></li>
                    <li><a href="#">Путин и Меркель на саммите G20 обсудили ситуацию
                            в Украине</a></li>
                    <li><a href="#">Дело об убийстве Шеремета имеет все шансы быть
                            расследуемым, — Аваков</a></li>
                </ul>
                <div class="line"></div>
            </div>
            <div class="news-posts__item">
                <span class="date-news__post">22 сен 20:16</span>
                <h4 class="category">Финансы</h4>
                <h5 class="post-header">Для расследования причин пожара на судне
                    ВМС «Донбасс» создана комиссия</h5>

                <div class="post-image">
                    <img src="/theme/portal-donbassa/img/news-post-item.jpg" alt="">
                </div>

                <p class="text-preview">Командующий Военно-морских сил ВСУ Игорь Воронченко назначил комиссию для
                    расследования причин пожара на судне </p>
                <a href="#" class="read-more">Читать дальше <img
                        src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>

                <ul class="more-news">
                    <li><a href="#">Сегодня комитет Европарламента рассмотрит вопрос
                            безвизового режима с Украиной</a></li>
                    <li><a href="#">Путин и Меркель на саммите G20 обсудили ситуацию
                            в Украине</a></li>
                    <li><a href="#">Дело об убийстве Шеремета имеет все шансы быть
                            расследуемым, — Аваков</a></li>
                </ul>
                <div class="line"></div>
            </div>
        </div>
        <div class="main-news-prefooter">
            <div class="social">
                <h4 class="social-header">МЫ В КОНТАКТЕ</h4>
                <img src="/theme/portal-donbassa/img/we-at-vk.jpg" alt="">

            </div>
            <div class="weather-forecast">
                <h4 class="weather-header">Погода</h4>
                <img src="/theme/portal-donbassa/img/prefooter-weather.jpg" alt="">
            </div>
            <div class="banner-bottom">
                <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">
            </div>
        </div>
    </div>
</div>
