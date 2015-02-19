<h1>Просмотр пользователя <?php echo $model->login; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'first_name',
		'second_name',
		'login',
	),
)); ?>
