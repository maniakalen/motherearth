<?php

/* @var $this yii\web\View */

\frontend\assets\AppAsset::register($this);
\maniakalen\maps\assets\LeafletAsset::registerMapAsset($this, 'map', 'pk.eyJ1IjoibWFuaWFrYWxlbiIsImEiOiJjanI2ZjJnNWwwOHA2NDluamVrN3lhdG81In0.YASdNSL-lEnFojai4C96kw', [42.5814857, 25.4725568], 8, ['attribution' => 'MotherEarth signup']);
\frontend\assets\MapsAsset::register($this);
\frontend\assets\MustacheJsAsset::register($this);
?>
<?php echo $this->render('/partials/header'); ?>
<div class="body-content">
    <div id="sidebar" class="list-group">
        <div class="filter-li filters">
            <div class="checkbox-filter">
                <label class="filter-checkbox-label">
                    <input type="checkbox" value="producer" name="usertype[]" class="filter-checkbox"><span class="btn btn-primary">Producer</span>
                </label>
            </div>

            <div class="checkbox-filter ">
                <label class="filter-checkbox-label">
                    <input type="checkbox" value="consumer" name="usertype[]" class="filter-checkbox"><span class="btn btn-primary">Consumer</span>
                </label>
            </div>
        </div>
    </div>
    <div id="map"></div>
</div>
<script type="text/template" id="users">
    <a href="#" data-user-id="{{id}}" class="user {{type}} list-group-item list-group-item-action flex-column align-items-start">

        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{name}}</h5>
            <small>3 days ago</small>
        </div>
        <p class="mb-1">{{location}}</p>
        <small>{{details}}</small>
    </a>
</script>
