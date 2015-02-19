<h1>Список пользователей</h1>

<?php echo CHtml::link(CHtml::htmlButton('Создать пользователя'), Yii::app()->createUrl('user/create')); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'first_name',
		'second_name',
		'login',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
