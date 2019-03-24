<?php

/* @var $this yii\web\View */

\frontend\assets\AppAsset::register($this);
\maniakalen\maps\assets\LeafletAsset::registerMapAsset($this, 'map', 'pk.eyJ1IjoibWFuaWFrYWxlbiIsImEiOiJjanI2ZjJnNWwwOHA2NDluamVrN3lhdG81In0.YASdNSL-lEnFojai4C96kw', [42.5814857, 25.4725568], 8, ['attribution' => 'MotherEarth signup']);
\frontend\assets\MapsAsset::register($this);
\frontend\assets\MustacheJsAsset::register($this);
?>
<?php echo $this->render('/partials/header'); ?>
<div class="body-content">
    <ul id="sidebar" class="displayed list-group">

    </ul>
    <div id="map"></div>
</div>
<script type="text/template" id="users">
    <li class="list-group-item user row {{type}}" data-user-id="{{id}}">
        <div class="user-photo col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <img src="{{photo}}" width="60" height="60" />
        </div>
        <div class="user-data col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">
            <h4>{{name}}</h4>
            <div class="location">
                {{location}}
            </div>
        </div>
    </li>
</script>
