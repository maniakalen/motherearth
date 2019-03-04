<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 2/23/2019
 * Time: 9:52 PM
 */
\frontend\assets\ProductsSignupAsset::register($this);
?>
<div class="site-index">


    <div class="row content ">
        <div class="col-md-12 signup-form">
            <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'form-signup', 'enableClientScript' => false]); ?>
            <?php echo $form->field($model, 'product_ids[]')->hiddenInput(['id' => 'user_product_ids'])->label(false); ?>
            <div class="form-group">
                <div class="col-md-6">
            <?php echo \yii\helpers\Html::textInput('products', null, ['id' => 'products', 'class' => 'form-control']); ?>
                </div>
                <div class="col-md-6">
                <?php echo \yii\helpers\Html::buttonInput('Add', ['id' => 'add_product', 'class' => 'btn btn-default hidden']); ?>
                </div>
            </div>
            <div class="row px-2" id="products_list_container"></div>
            <br/>
            <div class="form-group">
                <?php try {
                    echo \maniakalen\workflow\widgets\Actions::widget([
                        'actions' => \maniakalen\workflow\helpers\ActionsHelper::fetchActions($step->id, 1),
                        'translationCategory' => 'app'
                    ]);
                } catch (Exception $e) {
                    echo "Due to some strange issue buttons cannot be rendered at the moment";
                } ?>
                <div style="clear:both;"></div>
            </div>
            <br/><br/>
            <?php $form::end(); ?>
        </div>
    </div>
</div>
