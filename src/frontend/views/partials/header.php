<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 21/01/2019
 * Time: 11:31
 */
?>
<div class="header">
    <div class="logout pull-right">
        <?php $form = \yii\widgets\ActiveForm::begin(['action' => \yii\helpers\Url::to(['site/logout'])]); ?>
        <?php echo \yii\helpers\Html::submitButton('Logout', ['class' => 'btn btn-link']); ?>
        <?php $form::end(); ?>
    </div>
    <div class="logo"></div>
</div>
