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

    <h5><?= $question->title; ?></h5>

    <?php
    $k = 1;
    foreach ($possible_answers as $answer):?>
        <div class="pol-progress-cont">
            <div class="answer"><p><?= $k .'. ' . $answer['answer'];?></p></div>
            <div data-progress="<?= $answer['val_per'];?>"
                 class="poll-progressbar ui-progressbar ui-corner-all ui-widget ui-widget-content"
                 role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="ui-progressbar-value ui-corner-left ui-widget-header"
                     style="display: none; width: 4px;"></div>
            </div>
            <span class="result"><?= $answer['val'];?></span>
        </div>
    <?php $k++; endforeach; ?>
    <!--<h5 class="total">Всего проголосовало: <?/*= $answers_count ; */?> чел.</h5>-->


<!---->
<?php //\common\classes\Debug::prn($possible_answers); ?>
