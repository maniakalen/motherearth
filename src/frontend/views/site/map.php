<?php

/* @var $this yii\web\View */

\frontend\assets\AppAsset::register($this);
\maniakalen\maps\assets\LeafletAsset::registerMapAsset($this, 'map', 'pk.eyJ1IjoibWFuaWFrYWxlbiIsImEiOiJjanI2ZjJnNWwwOHA2NDluamVrN3lhdG81In0.YASdNSL-lEnFojai4C96kw', [42.5814857, 25.4725568], 8, ['attribution' => 'MotherEarth signup']);
\frontend\assets\MapsAsset::register($this);
?>
<?php echo $this->render('/partials/header'); ?>
<div class="body-content">
    <div id="map"></div>
</div>
