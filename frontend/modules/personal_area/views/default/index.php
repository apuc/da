<section class="cabinet">

    <div class="container">

        <div class="cabinet__tollbar">

            <div class="cabinet__avatar">
                <img src="img/users-avatars/1.jpg" alt="">
            </div>

            <a href="#" class="cabinet__avatar--edit"></a>

            <div class="cabinet__info">

                <h1>Компания феникс</h1>

                <p class="cabinet__pkg">Пакет расширенный</p>

                <p class="cabinet__pkg-time">до <span>23.05.2015 (еще 1 месяц)</span></p>

                <a href="#" class="cabinet__add-pkg"></a>

                <a href="#" class="cabinet__froze-pkg">Заморозить абонемент</a>

                <a href="#" class="show-more">РЕДАКТИРОВАТЬ</a>

            </div>

            <ul class="cabinet__list">
                <li><a href="#" class="news">НОВОСТИ <span>258</span></a></li>
                <li><a href="#" class="poster">АФИШИ</a></li>
                <li><a href="#" class="stock">АКЦИИ</a></li>
                <li><a href="#" class="configuration">Настройки</a></li>
                <li><a href="#" class="company">ПРЕДПРИЯТИЯ <span class="add"></span></a></li>
                <li><a href="#" class="comments">КОМЕНТАРИИ <span class="add"></span></a></li>
                <li><a href="#" class="notice">Уведомления <span>89</span></a></li>
            </ul>

        </div>

        <div class="cabinet__main">

            <div class="cabinet__owner">

                <h3>Завидовский Виктор Олегович</h3>

                <p>
                    <span></span>
                    Донецк
                </p>

            </div>

            <div class="cabinet__owner-tools">

                <a href="#" class="active">

                    <span>25</span>

                    <p>подписок</p>

                </a>

                <a href="#">

                    <span>25</span>

                    <p>акций</p>

                </a>

                <a href="#">

                    <span>125</span>

                    <p>компаний</p>

                </a>

                <a href="#">

                    <span>225</span>

                    <p>отзывов</p>

                </a>

                <a href="#">

                    <span>88825</span>

                    <p>коментария</p>

                </a>

            </div>

            <?= $this->render('_user-news', ['userNews' => $userNews]); ?>

            <div class="cabinet__statistics">

                <h3>Посещения</h3>

                <div class="cabinet__statistics--item">

                    <span>2</span>

                    <p>на этой неделе</p>

                </div>

                <div class="cabinet__statistics--item">

                    <span>3</span>

                    <p>на прошлой неделе</p>

                </div>

                <div class="cabinet__statistics--item">

                    <span>58</span>

                    <p>в этом месяце</p>

                </div>

                <div class="cabinet__statistics--item">

                    <span>368</span>

                    <p>всего</p>

                </div>

            </div>

            <div class="cabinet__inner-box">

                <h3>Мои компании</h3>

                <a href="#" class="cabinet__inner-box--add">добавить <span><img src="img/icons/add-pkg-icon.png" alt=""></span></a>

                <div href="#" class="business__sm-item">

                    <div class="recommend">
                        <span class="recommend__star"></span>
                        Рекомендуем
                    </div>

                    <div class="business__sm-item--img">
                        <img src="img/business/business-sm.png" alt="">
                    </div>

                    <p class="business__sm-item--title">Региональный центр восстановления позвоночника и
                        реабилитации</p>

                    <p class="business__sm-item--address">
                        <span>Адрес:</span>
                        <span>г. Донецк, проспект Мира, 8а</span>
                    </p>

                    <ul class="business__sm-item--numbers">
                        <li>+380667778540</li>
                        <li>+380667778540</li>
                    </ul>

                    <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                    <p class="business__sm-item--views">569</p>

                    <div class="cabinet__inner-box--toolth">

                        <a href="">
                            <img src="img/icons/cabinetd-delete-icon.png" alt="">
                        </a>
                        <a href="">
                            <img src="img/icons/cabinet-edit-icon.png" alt="">
                        </a>
                        <a href="">
                            <img src="img/icons/cabinet-show-icon.png" alt="">
                        </a>

                    </div>

                </div>

                <a href="#" class="business__big-item">

                    <div class="recommend">
                        <span class="recommend__star"></span>
                        Рекомендуем
                    </div>

                    <div class="business__sm-item--img">
                        <img src="img/business/business-sm.png" alt="">
                    </div>

                    <p class="business__sm-item--title">Региональный центр восстановления позвоночника и
                        реабилитации</p>

                    <!--<p class="business__big-item&#45;&#45;address">
                        <span>Время работы Министерства:</span>
                        <span>с 9:00 до 18:00 (перерыв с 13:00 до 14:00)</span>
                    </p>-->

                    <p class="business__sm-item--address">
                        <span>Адрес:</span>
                        <span>г. Донецк, проспект Мира, 8а</span>
                    </p>

                    <ul class="business__sm-item--numbers">
                        <li>+380667778540</li>
                        <li>+380667778540</li>
                    </ul>

                    <ul class="business__sm-item--numbers">
                        <li>+380667778540</li>
                        <li>+380667778540</li>
                    </ul>

                    <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                    <p class="business__sm-item--views">569</p>

                </a>

                <a href="#" class="business__sm-item">

                    <div class="recommend">
                        <span class="recommend__star"></span>
                        Рекомендуем
                    </div>

                    <div class="business__sm-item--img">
                        <img src="img/business/business-sm.png" alt="">
                    </div>

                    <p class="business__sm-item--title">Региональный центр восстановления позвоночника и
                        реабилитации</p>

                    <p class="business__sm-item--address">
                        <span>Адрес:</span>
                        <span>г. Донецк, проспект Мира, 8а</span>
                    </p>

                    <ul class="business__sm-item--numbers">
                        <li>+380667778540</li>
                        <li>+380667778540</li>
                    </ul>

                    <!--<span class="business__sm-item&#45;&#45;views-icon"></span>-->
                    <p class="business__sm-item--views">569</p>

                </a>

            </div>

        </div>

    </div>

</section>