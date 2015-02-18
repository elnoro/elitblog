<div class="container">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'filter' => $model,
    'columns' =>
    [
    	'id', 'login', 'first_name', 'second_name', ['class' => 'CButtonColumn'],
    ]
));
?>
</div>