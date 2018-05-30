<?php
/**
* @var $rating
*/
?>

<ul class="stars">
    <li class="<?= $rating >= 1 ? 'star selected': 'star'?>" title="Poor" data-value="1">
        <i class="fa fa-star fa-fw"></i>
    </li>
    <li class="<?= $rating >= 2 ? 'star selected': 'star'?>" title="Fair" data-value="2">
        <i class="fa fa-star fa-fw"></i>
    </li>
    <li class="<?= $rating >= 3 ? 'star selected': 'star'?>" title="Good" data-value="3">
        <i class="fa fa-star fa-fw"></i>
    </li>
    <li class="<?= $rating >= 4 ? 'star selected': 'star'?>" title="Excellent" data-value="4">
        <i class="fa fa-star fa-fw"></i>
    </li>
    <li class="<?= $rating >= 5 ? 'star selected': 'star'?>" title="WOW!!!" data-value="5">
        <i class="fa fa-star fa-fw"></i>
    </li>
</ul>