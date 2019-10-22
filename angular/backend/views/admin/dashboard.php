<?php

/** @var \yii\data\ActiveDataProvider $activeUsers */
/** @var \yii\data\ActiveDataProvider $products */
?>
<div class="row">
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <?= \Yii::t('app', 'Users online') ?>
        </div>
        <div class="card-body">
            <?php

            echo \yii\widgets\ListView::widget([
                'itemView' => function($model) { return '<div>' . $model->username. ' | ' . date('H:i d/m/y', $model->updated_at) . '</div>'; },
                'dataProvider' => $activeUsers,
                'layout' => "{items}\n{pager}"
            ]);

            ?>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <?= \Yii::t('app', 'Products list') ?>
        </div>
        <div class="card-body">
            <?php

            echo \yii\widgets\ListView::widget([
                'itemView' => function($model) {
                    return '<div class="' . ($model->status?'':'red') . '">' .
                        $model->name . ' ' .
                        (!$model->status?
                            \app\widgets\Dropdown::widget([
                                'dropDownTitle' => '<i class="fas fa-bars"></i>',
                                'inline' => true,
                                'style' => 'default',
                                'items' => [
                                    ['label' => 'Active', 'url' => ['/products/activate', 'id' => $model->id]],
                                    ['label' => 'Remove', 'url' => ['/products/remove', 'id' => $model->id]]
                                ]
                            ]):'') .
                        '</div>';
                },
                'dataProvider' => $products,
                'layout' => "{items}\n{pager}"
            ]);

            ?>
        </div>
    </div>
</div>
</div>
