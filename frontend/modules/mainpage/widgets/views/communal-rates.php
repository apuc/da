<?php
use yii\helpers\Url;
?>
<div class="home-content__wrap_komunalka">
    <div class="title_row">
        <h3>комунальные тарифы</h3>
        <a href="<?= Url::to(['/site/design']); ?>" class="show-enterprises">все тарифы<span class="red-arrow"></span></a>
    </div>
    <div class="komunalka">

        <div class="komunalka__item komunalka__line_active">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/energy.png" alt="">
            </span>
            <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'elektricestvo']) ?>" class="komunalka__line ">
                <span>электричество</span>
                <span class="red-arrow"></span>
            </a>
        </div>
        <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/wind.png" alt="">
            </span>
            <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'otoplenie']) ?>" class="komunalka__line">
                <span>отопление</span>
                <span class="red-arrow"></span>
            </a>
        </div>
        <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/gas.png" alt="">
            </span>
            <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'gaz']) ?>" class="komunalka__line">
                <span>газ </span>
                <span class="red-arrow"></span>
            </a>
        </div>
        <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/home.png" alt="">
            </span>
            <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'zkh']) ?>" class="komunalka__line">
                <span>жкх</span>
                <span class="red-arrow"></span>
            </a>
        </div>
        <div class="komunalka__item">
                        <span class="komunalka__icon">
                          <img src="/theme/portal-donbassa/img/home-content/water.png" alt="">
                        </span>
            <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'voda']) ?>" class="komunalka__line"><span>вода</span><span class="red-arrow"></span></a>
        </div>
        <div class="komunalka__item">
                        <span class="komunalka__icon">
                          <img src="/theme/portal-donbassa/img/home-content/internet.png" alt="">
                        </span>
            <a href="<?= Url::to(['/site/design']); ?>" class="komunalka__line">
                <span>интернет</span><span class="red-arrow"></span></a>
        </div>
        <div class="komunalka__item">
                        <span class="komunalka__icon">
                          <img src="/theme/portal-donbassa/img/home-content/phone.png" alt="">
                        </span>
            <a href="<?= Url::to(['/site/design']); ?>" class="komunalka__line"><span>связь</span><span class="red-arrow"></span></a>
        </div>
        <div class="komunalka__item">
                        <span class="komunalka__icon">
                          <img src="/theme/portal-donbassa/img/home-content/transport.png" alt="">
                        </span>
            <a href="<?= Url::to(['/site/design']); ?>" class="komunalka__line"><span>транспорт</span><span class="red-arrow"></span></a>
        </div>
    </div>
</div>

<!--<div class="home-content__wrap_komunalka">
    <div class="title_row">
        <h3>комунальные тарифы</h3>
        <a href="<?/*= Url::to(['/site/design']); */?>" class="show-enterprises">все тарифы<span
                class="red-arrow"></span></a>
    </div>
    <div class="komunalka">

        <div class="komunalka__item komunalka__line_active">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/energy.png" alt="">
            </span>
            <a href="<?/*= Url::to(['/consulting/consulting/document', 'slug' => 'elektricestvo']) */?>"
               class="komunalka__line "><span>электричество</span><span class="red-arrow"></span></a>
        </div>
        <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/wind.png" alt="">
            </span>
            <a href="<?/*= Url::to(['/consulting/consulting/document', 'slug' => 'otoplenie']) */?>"
               class="komunalka__line"><span>отопление</span> <span class="red-arrow"></span></a>
        </div>
        <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/gas.png" alt="">
            </span>
            <a href="<?/*= Url::to(['/consulting/consulting/document', 'slug' => 'gaz']) */?>" class="komunalka__line">
                <span>газ</span>
                <span class="red-arrow"></span></a>
        </div>
        <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/home.png" alt="">
            </span>
            <a href="<?/*= Url::to(['/consulting/consulting/document', 'slug' => 'zkh']) */?>" class="komunalka__line">
                <span>жкх</span>
                <span class="red-arrow"></span></a>
        </div>
        <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/water.png" alt="">
            </span>
            <a href="<?/*= Url::to(['/consulting/consulting/document', 'slug' => 'voda']) */?>" class="komunalka__line">
                <span>вода</span>
                <span class="red-arrow"></span>
            </a>
        </div>
    </div>
</div>-->