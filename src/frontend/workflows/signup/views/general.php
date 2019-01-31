<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use maniakalen\workflow\widgets\Actions;
use maniakalen\workflow\helpers\ActionsHelper;
\frontend\assets\SignupAsset::register($this);
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">


    <div class="row content ">
        <div class="col-md-6 signup-form col-md-offset-3">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to signup:</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'phone')->passwordInput() ?>

            <?= $form->field($model, 'details')->textarea() ?>
            <div class="form-group">
                <?php try {
                    echo Actions::widget([
                            'actions' => ActionsHelper::fetchActions($step->id, 1),
                            'translationCategory' => 'app'
                    ]);
                } catch (Exception $e) {
                    echo "Due to some strange issue buttons cannot be rendered at the moment";
                } ?>
                <div style="clear:both;"></div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
