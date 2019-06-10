<?php
use yii\helpers\Html;

\frontend\assets\LoginAsset::register($this);
\maniakalen\maps\assets\LeafletAsset::registerMapAsset($this, 'minimap', 'pk.eyJ1IjoibWFuaWFrYWxlbiIsImEiOiJjanI2ZjJnNWwwOHA2NDluamVrN3lhdG81In0.YASdNSL-lEnFojai4C96kw', [42.5814857, 25.4725568], 8, ['attribution' => 'MotherEarth signup']);
\frontend\assets\BloodhoundAsset::register($this);
\frontend\assets\LocationSignupAsset::register($this);
\frontend\assets\LeafletSignupAsset::register($this);
\frontend\assets\ProductsSignupAsset::register($this);
\frontend\assets\ProfileAsset::register($this);
?>
<div class="site-index">
    <div class="row content profile">
        <div class="col-md-12 login-form row">
            <h2 class="col-md-12"><?= Html::encode($data->name . '\'s profile') ?></h2>
            <?php $form = \yii\widgets\ActiveForm::begin(); ?>
            <div class="col-md-6 row">
                <div class="col-md-12">
                    <?php echo $form->field($user, 'email')->textInput(['placeholder' => 'email'])->label(false); ?>
                    <?php echo $form->field($data, 'name')->textInput(['placeholder' => 'name'])->label(false); ?>
                    <?php echo $form->field($data, 'surname')->textInput(['placeholder' => 'surname'])->label(false); ?>
                    <?php echo $form->field($data, 'phone')->textInput(['placeholder' => 'phone'])->label(false); ?>
                    <?php echo $form->field($data, 'details')->textInput(['placeholder' => 'details'])->textarea()->label(false); ?>
                </div>
                <div class="col-md-12 products-block row m-b-15p">
                    <div class="col-md-12 m-b-15p">
                        <?php echo \yii\helpers\Html::textInput('products', null, ['placeholder' => 'Add new produt', 'id' => 'products', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-12 row" id="products-list">
                    </div>

                </div>
            </div>
            <div class="col-md-6 border-left">
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <?= Html::input('text', 'address', $location->addressData->name, ['label' => 'Адрес', 'class' => 'form-control typeahead typeahead-location', 'id' => 'address']) ?>
                        <?= $form->field($location, 'address')->hiddenInput(['id' => 'address-input'])->label(false) ?>

                    </div>
                    <div id="minimap"></div>
                </div>
                <div class="col-md-12">

                </div>
            </div>
            <div class="col-md-12">
                <?php echo Html::submitInput('Submit', ['class' => 'btn btn-primary']); ?>
            </div>
            <?php $form::end(); ?>
        </div>
    </div>
</div>
