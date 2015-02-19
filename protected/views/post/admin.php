
<h1>Управление постами</h1>
<?php
if (!Yii::app()->user->isGuest) {
	echo CHtml::link(CHtml::htmlButton('Новый пост'), Yii::app()->createUrl('post/create'));
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		[
			'name' => 'author_id',
			'value' => '$data->author->fullName',
		],
		'text',
		'date',
		array(
			'class'=>'CButtonColumn',
		),
	),
));

