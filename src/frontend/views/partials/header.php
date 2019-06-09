<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 21/01/2019
 * Time: 11:31
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="header">

        <?php if (\Yii::$app->user->isGuest): ?>
            <div class="logout pull-right">
                <a href="<?php echo Url::to(['site/login']); ?>" class="btn btn-link">Login</a>
            </div>
        <?php else: ?>
            <div class="logout pull-right">
            <?php $form = ActiveForm::begin(['action' => Url::to(['site/logout'])]); ?>
            <?php echo Html::submitButton('Logout', ['class' => 'btn btn-link']); ?>
            <?php $form::end(); ?>
            </div>
            <div class="pull-right">
                <div>
                    <a href="<?php echo Url::to(['site/profile']); ?>" class="btn btn-link">Profile</a>
                </div>
            </div>
        <?php endif ?>



</div>
