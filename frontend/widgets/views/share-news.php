<?php
/**
 * @var array $options
 */

if (empty($options['image'])) {
    $image = '/theme/portal-donbassa/img/logo.png';
} else {
    $image = $options['image'];
}
?>

<div class="social-wrapper">
    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
    <script src="//yastatic.net/share2/share.js"></script>
    <div class="ya-share2"
         data-bare
         data-services="vkontakte,facebook,odnoklassniki,gplus,pinterest,twitter,linkedin,lj"
         data-image="<?= $image; ?>">
    </div>
</div>