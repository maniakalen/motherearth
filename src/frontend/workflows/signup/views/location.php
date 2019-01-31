<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use maniakalen\workflow\widgets\Actions;
use maniakalen\workflow\helpers\ActionsHelper;
\frontend\assets\SignupAsset::register($this);
\maniakalen\maps\assets\LeafletAsset::registerMapAsset($this, 'minimap', 'pk.eyJ1IjoibWFuaWFrYWxlbiIsImEiOiJjanI2ZjJnNWwwOHA2NDluamVrN3lhdG81In0.YASdNSL-lEnFojai4C96kw', [42.5814857, 25.4725568], 8);
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">


    <div class="row content ">
        <div class="col-md-12 signup-form">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please provide your exact location:</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <div id="minimap"></div>
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
