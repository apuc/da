<?php
?>
<div class="social-wrapper">
    <a onclick="Share.vkontakte(
            '<?= $options['url'] ?>',
            '<?= $options['title'] ?>',
            '<?= $options['image']; ?>',
            '<?= $options['description']; ?>'
            ); return false;"
       href="#" target="_blank" class="social-wrap__item vk">
        <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
    </a>
    <a onclick="Share.facebook(
            '<?= $options['url'] ?>',
            '<?= $options['title']; ?>',
            '<?= $options['image']; ?>',
            '<?= $options['description']; ?>')"
       href="#" target="_blank" class="social-wrap__item fb">
        <img src="/theme/portal-donbassa/img/soc/fb.png" alt="fb">
    </a>
    <a onclick="Share.odnoklassniki(
            '<?= $options['url'] ?>',
            '<?= $options['title']; ?>'
            )" href="#" target="_blank" class="social-wrap__item ok">
        <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="ok">
    </a>
    <!--<a href="#" target="_blank" class="social-wrap__item insta">-->
    <!--    <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="instagramm">-->
    <!--</a>-->
    <!--<a href="#" target="_blank" class="social-wrap__item google">-->
    <!--    <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="google">-->
    <!--</a>-->
    <a onclick="Share.twitter(
            '<?= $options['url'] ?>',
            '<?= $options['title'] ?>')" href="#" target="_blank" class="social-wrap__item twitter">
        <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="twitter">
    </a>
</div>
<div class="hide-social">

    <span onclick="Share.vkontakte(
            '<?= $options['url'] ?>',
            '<?= $options['title'] ?>',
            '<?= $options['image']; ?>',
            '<?= $options['description']; ?>'
            ); return false;">
        <i class="fa fa-vk  fa-lg"></i>
    </span>

    <span onclick="Share.twitter(
            '<?= $options['url'] ?>',
            '<?= $options['title'] ?>')">
        <i class="fa fa-twitter fa-lg"></i>
    </span>

    <span onclick="Share.facebook(
            '<?= $options['url'] ?>',
            '<?= $options['title']; ?>',
            '<?= $options['image']; ?>',
            '<?= $options['description']; ?>')"><i class="fa fa-facebook fa-lg"></i>
    </span>

    <span onclick="Share.odnoklassniki(
            '<?= $options['url'] ?>',
            '<?= $options['title']; ?>'
            )"><i class="fa fa-odnoklassniki  fa-lg"></i>
    </span>
</div>
<span class="open-soc"><i class="fa fa-random fa-lg"></i></span>
