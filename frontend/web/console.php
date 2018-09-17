<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 10.08.2017
 * Time: 10:19
 */

if ($_GET['p'] === 'vk/get-stream') {

    // параметры вводимые в консоли, только уже в виде масива
    $_SERVER['argv'] = [0 => __FILE__, 1 => 'vk/get-stream'];

    // к-во элементов массива argv
    $_SERVER['argc'] = 2;

    require '../../yii';

}