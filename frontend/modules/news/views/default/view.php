<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 16:15
 * @var $news \common\models\db\News
 */

$this->registerMetaTag([
    'name' => 'og:image',
    'content' => 'http://' . $_SERVER['HTTP_HOST'] . $news->photo,
]);
$this->title = $news->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $news->meta_descr,
]);
?>
<!-- close .header -->

<!-- end header.html-->

<main id="main-single-news">

    <div class="container">

        <article id="article">
            <div class="thumbnail-wrapper">
                <img class="thumbnail" src="<?= $model->photo; ?>" alt="">
            </div>

            <div class="breadcrumbs">
                <a href="#">Главная</a> <span>></span> <a href="#">Финансы</a>
            </div>

            <div class="content-single-wrapper">

                <h1><?= $model->title; ?></h1>

                <div class="content-info">
                    <span class="author">Николай Иванович</span>
                    <span class="comments">20 комментариев</span>
                    <span class="views"><?= $model->views; ?></span>
                    <span class="data-time"><?= date('d',
                            $model->dt_public) . ' ' .
                        \common\classes\WordFunctions::getRuMonth()[date('m', $model->dt_public)] . ' ' .
                        date('Y', $model->dt_public) . ', в ' .
                        date('H:i',$model->dt_public)
                        ;?></span>
                    <span class="like"><?= $likes;?></span>
                </div>

                <div class="content-single">
                    <?= $model->content; ?>
                </div>

                <div class="content-info">
                    <span class="author">Николай Иванович</span>
                    <span class="comments">20 комментариев</span>
                    <span class="views"><?= $model->views; ?></span>
                    <span class="data-time"><?= date('d',
                            $model->dt_public) . ' ' .
                        \common\classes\WordFunctions::getRuMonth()[date('m', $model->dt_public)] . ' ' .
                        date('Y', $model->dt_public) . ', в ' .
                        date('H:i',$model->dt_public)
                        ;?></span>
                    <span class="like"><?= $likes;?></span>
                </div>

                <div class="tags">
                    <h3>Теги:</h3>
                    <?php
                    foreach ($tags as $tag): ?>
                        <a><?= $tag; ?></a>
                    <?php endforeach; ?>
                </div>

                <!-- start socials.html-->
                <div class="social-wrapper">
                    <a href="#" target="_blank" class="social-wrap__item vk">
                        <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                        <span>03</span>
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item fb">
                        <img src="/theme/portal-donbassa/img/soc/fb.png" alt="fb">
                        <span>12</span>
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item ok">
                        <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="ok">
                        <span>05</span>
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item insta">
                        <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="instagramm">
                        <span>63</span>
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item google">
                        <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="google">
                        <span>36</span>
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item twitter">
                        <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="twitter">
                        <span>11</span>
                    </a>
                </div>
                <!-- end socials.html-->

            </div>

            <!-- start comments.html-->
            <div class="comments-wrapper">

                <div class="after-comments">
                    <h2>Комментарии к новости</h2>

                    <a href="#" class="populiation">Популярные впереди</a><a href="#">Написать свой</a>
                </div>

                <div class="comments">
                    <div class="comment-wrapper moder">
                        <div class="user">
                            <span>12</span>
                            <div class="user-photo">
                                <img src="/theme/portal-donbassa/img/users-avatars/1.jpg" alt="">
                            </div>

                            <a href="#" class="up"></a>
                            <a href="#" class="down"></a>
                        </div>
                        <div class="comment">
                            <div class="comment-info-wrapper">
                                <div class="user-name">Кирилл Кириленко</div>

                                <div class="comment-info">
                                    <div class="modern-comment">Выделен модератором</div>
                                    <a href="#">Ответить</a>
                                    <div class="time">16:43:12</div>
                                </div>
                            </div>

                            <div class="text">
                                Также хотят запретить выезд из страны имеющим судимость за «экстремизм» и вводить режим
                                КТО в случаях «посягательства на жизнь государственного или общественного деятеля»,
                                «насильственного захвата власти», «вооруженного мятежа»
                            </div>
                        </div>
                    </div>

                    <div class="comment-wrapper">
                        <div class="user">
                            <span>12</span>
                            <div class="user-photo">
                                <img src="/theme/portal-donbassa/img/users-avatars/2.jpg" alt="">
                            </div>

                            <a href="#" class="up"></a>
                            <a href="#" class="down"></a>
                        </div>
                        <div class="comment">
                            <div class="comment-info-wrapper">
                                <div class="user-name">Егор Рябцев</div>

                                <div class="comment-info">
                                    <a href="#">Ответить</a>
                                    <div class="time">16:43:12</div>
                                </div>
                            </div>

                            <div class="text">
                                Также хотят запретить выезд из страны имеющим судимость за «экстремизм» и вводить режим
                                КТО в случаях «посягательства на жизнь государственного или общественного деятеля»,
                                «насильственного захвата власти», «вооруженного мятежа»
                            </div>

                            <div class="child-comment">
                                <div class="user">
                                    <span>12</span>
                                    <div class="user-photo">
                                        <img src="/theme/portal-donbassa/img/users-avatars/2.jpg" alt="">
                                    </div>

                                    <a href="#" class="up"></a>
                                    <a href="#" class="down"></a>
                                </div>
                                <div class="comment">
                                    <div class="comment-info-wrapper">
                                        <div class="user-name">Малик Янтижанов</div>
                                        <div class="moder">Модератор</div>

                                        <div class="comment-info">
                                            <a href="#">Ответить</a>
                                            <div class="time">16:43:12</div>
                                        </div>
                                    </div>

                                    <div class="text">Попахивает рекламой?</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="comment-wrapper">
                        <div class="user">
                            <span>12</span>
                            <div class="user-photo">
                                <img src="/theme/portal-donbassa/img/users-avatars/1.jpg" alt="">
                            </div>

                            <a href="#" class="up"></a>
                            <a href="#" class="down"></a>
                        </div>
                        <div class="comment">
                            <div class="comment-info-wrapper">
                                <div class="user-name">Кирилл Кириленко</div>

                                <div class="comment-info">
                                    <a href="#">Ответить</a>
                                    <div class="time">16:43:12</div>
                                </div>
                            </div>

                            <div class="text">
                                Также хотят запретить выезд из страны имеющим судимость за «экстремизм» и вводить режим
                                КТО в случаях «посягательства на жизнь государственного или общественного деятеля»,
                                «насильственного захвата власти», «вооруженного мятежа»
                            </div>
                        </div>
                    </div>

                    <a href="#" class="load-more">загрузить БОЛЬШЕ</a>

                </div>
            </div>
            <!-- end comments.html-->

        </article>

        <!-- start right_sidebar_news.html-->
        <aside id="aside">
            <div class="scroll">
                <div class="more-news">

                    <h3>Читайте по теме</h3>

                    <ul>
                        <li>
                            <span>4 мая 2016, в 15:00 копия</span>
                            <a href="#">Пушков прокомментировал встречу Петра Порошенко и Си Цзиньпина</a>
                        </li>
                        <li>
                            <span>4 мая 2016, в 15:00 копия</span>
                            <a href="#">Пушков прокомментировал встречу Петра Порошенко и Си Цзиньпина</a>
                        </li>
                        <li>
                            <span>4 мая 2016, в 15:00 копия</span>
                            <a href="#">Пушков прокомментировал встречу Петра Порошенко и Си Цзиньпина</a>
                        </li>
                        <li>
                            <span>4 мая 2016, в 15:00 копия</span>
                            <a href="#">Пушков прокомментировал встречу Петра Порошенко и Си Цзиньпина</a>
                        </li>
                        <li>
                            <span>4 мая 2016, в 15:00 копия</span>
                            <a href="#">Пушков прокомментировал встречу Петра Порошенко и Си Цзиньпина</a>
                        </li>
                    </ul>
                </div>

                <div class="articles">
                    <div class="article">
                        <img src="/theme/portal-donbassa/img/content/news-photo.jpg" alt="">

                        <div class="time">4 часа назад</div>
                        <a href="#">Пассажир поблагодарил
                            пилотов, отказавшихся
                            сажать самолет в Ростове</a>

                        <div class="po-teme">Популярное</div>
                    </div>

                    <div class="article">
                        <img src="/theme/portal-donbassa/img/content/news-photo.jpg" alt="">

                        <div class="time">4 часа назад</div>
                        <a href="#">Пассажир поблагодарил
                            пилотов, отказавшихся
                            сажать самолет в Ростове</a>
                    </div>

                    <div class="article">
                        <img src="/theme/portal-donbassa/img/content/news-photo.jpg" alt="">

                        <div class="time">4 часа назад</div>
                        <a href="#">Пассажир поблагодарил
                            пилотов, отказавшихся
                            сажать самолет в Ростове</a>
                    </div>
                </div>
            </div>
        </aside>
        <!-- end right_sidebar_news.html-->

    </div>
</main>

<!-- start footer.html-->
