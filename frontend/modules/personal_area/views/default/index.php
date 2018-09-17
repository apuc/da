<?php
$this->title = "Личный кабинет";
?>

<?= $this->render('_user-news', ['userNews' => $userNews]); ?>

<?= \frontend\modules\personal_area\widgets\ShowVisitsUser::widget(); ?>

<?= $this->render('_user-company', ['userCompany' => $userCompany]); ?>






