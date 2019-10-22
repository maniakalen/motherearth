<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use app\widgets\Nav;
use app\widgets\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\ArrayHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'toggleButton' => false,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-light bg-light',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav justify-content-center'],
        'items' => ArrayHelper::merge(
                ArrayHelper::getValue(\Yii::$app->params, 'menu', []),
                [Yii::$app->user->isGuest ? ([
                    'label' => 'Login',
                    'url' => ['/admin/login'],
                    'options' => ['class' => 'nav-item'],
                    'linkOptions' => ['class' => 'nav-link']
                ]) : (
                '<li>'
                . Html::beginForm(['/admin/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ]),
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'itemTemplate' => "<li class=\"breadcrumb-item\">{link}</li>\n",
            'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n"
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
