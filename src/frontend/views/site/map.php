<?php

/* @var $this yii\web\View */

\frontend\assets\AppAsset::register($this);
\maniakalen\maps\assets\LeafletAsset::registerMapAsset($this, 'map', 'pk.eyJ1IjoibWFuaWFrYWxlbiIsImEiOiJjanI2ZjJnNWwwOHA2NDluamVrN3lhdG81In0.YASdNSL-lEnFojai4C96kw', [42.5814857, 25.4725568], 8, ['attribution' => 'MotherEarth signup']);
\frontend\assets\MapsAsset::register($this);
\frontend\assets\MustacheJsAsset::register($this);
?>
<?php echo $this->render('/partials/header'); ?>
<div class="body-content">
    <div id="sidebar">

    </div>
    <div id="map"></div>
</div>
<script type="text/template" id="users">
    <div class="user {{type}}">
        <div class="user-photo">
            <img src="{{photo}}" width="45" height="45" />
        </div>
        <div class="user-data">
            <h3>{{name}}</h3>
            <div class="location">
                {{location}}
            </div>
        </div>
    </div>
</script>
