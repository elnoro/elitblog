<h1>Просмотр поста #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		[
			'name' => 'author_id',
			'type' => 'raw',
			'value' => $model->author->getFullName(),
		],
		'text',
		'date',
	),
)); ?>
