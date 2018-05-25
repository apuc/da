<?php
echo '<a href="/secure/vk/vk_groups">Назад</a>';
echo '<br>';

if($_GET['p']=='vk/get-stream'){
    set_time_limit(0);
    // параметры вводимые в консоли, только уже в виде масива
    $_SERVER['argv'] = [ 0=>__FILE__, 1=>'vk/get-stream', 3=>$_GET['id']];
    //if(!empty($_GET['id'])) $_SERVER['argv'][1] .= ' '.$_GET['id'];
    // к-во элементов массива argv
    $_SERVER['argc'] = 3;

    require '../../yii';

}

if($_GET['p']=='vk/get-group-info'){
    set_time_limit(0);
    // параметры вводимые в консоли, только уже в виде масива
    $_SERVER['argv'] = [ 0=>__FILE__, 1=>'vk/get-group-info'];
    //if(!empty($_GET['id'])) $_SERVER['argv'][1] .= ' '.$_GET['id'];
    // к-во элементов массива argv
    $_SERVER['argc'] = 2;

    require '../../yii';

}