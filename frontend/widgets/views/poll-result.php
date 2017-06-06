<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 29.09.2016
 * Time: 16:35
 * @var $top_company \common\models\db\TopCompany
 */
use yii\helpers\Html;

?>

    <!-- <span class="red-line"></span> -->
    <h3>Голосование</h3>
    <hr>
    <h5><?= $question->title; ?></h5>

    <?php foreach ($possible_answers as $answer):?>
        <div class="pol-progress-cont">
            <div class="answer"><p><?= $answer['answer'];?></p></div>
            <div data-progress="<?= $answer['val_per'];?>" class="poll-progressbar"></div>
            <span class="result"><?= $answer['val'];?></span>
        </div>
    <?php endforeach; ?>
    <h5 class="total">Всего проголосовало: <?= $answers_count ; ?> чел.</h5>


<!---->
<?php //\common\classes\Debug::prn($possible_answers); ?>
