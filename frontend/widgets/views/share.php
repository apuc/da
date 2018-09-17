<?php
?>
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
