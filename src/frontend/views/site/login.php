<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
\frontend\assets\LoginAsset::register($this);
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="row content">
        <div class="col-md-6 login-form col-md-offset-3">
            <h2><?= Html::encode($this->title) ?></h2>

            <p>Please fill out the following fields to login:</p>


            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <div class="no-profile">
                    <div class="no-profile-or">или</div>
                    Ако все още нямате профил може да направите вашата регистрация <a href="<?php echo \yii\helpers\Url::to(['signup/general']); ?>" class="btn btn-link">Тук</a>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
