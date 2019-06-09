<?php
foreach ($products as $id => $item):
?>
<a class="col-md-2 btn btn-warning" data-product-id="<?php echo $id; ?>"> <?php echo $item; ?> </a>
<?php endforeach; ?>

