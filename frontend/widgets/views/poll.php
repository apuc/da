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
<h4>Голосование</h4>
    <h5><?= $question->title; ?></h5>
    <form action="#">
        <?php foreach ( $possible_answers as $answer ): ?>
            <label><p><input data-id = '<?= $answer->id;?>' name="answer" type="radio" value="<?= $answer->id; ?>"><?= $answer->title; ?></p></label>
        <?php endforeach; ?>
        <input class="add-ad sbm-poll" type="submit" placeholder="Отправить">
    </form>

