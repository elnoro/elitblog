<?php 
Yii::app()->getClientScript()->registerScript('setDateFormat', "
	jQuery.datepicker.regional['ru'].dateFormat = 'yy-mm-dd';
");
Yii::app()->clientScript->registerScript('re-install-date-picker', "
	function reinstallDatePicker(id, data) {
	    $('.post_filter_dp').datepicker(
	    	jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ru'],{})
	    );
	    $.map(window.post_filter_dp, function (date, id) {
	    	$('#' + id).datepicker('setDate', date);
	    });
	}
	window.post_filter_dp = {};
	function saveDatePickerValues() {
		$('.post_filter_dp').each(function (ix, elem)
		{
			window.post_filter_dp[$(elem).attr('id')] = $(elem).val();
		});
	}
");

function datePicker ($controller, $name) {
	return $controller->widget('zii.widgets.jui.CJuiDatePicker', [
		'language'=>'ru',
		'name'=> $name, 
		'htmlOptions' => ['class' => 'post_filter_dp'],
		'defaultOptions'=> ['showAnim'=>'fold'],
	], true) . '<br>';
} 
?>
<h1>Управление постами</h1>
<?php
if (!Yii::app()->user->isGuest) {
	echo CHtml::link(CHtml::htmlButton('Новый пост'), Yii::app()->createUrl('post/create'));
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'beforeAjaxUpdate' => 'saveDatePickerValues',
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		'id',
		[
			'name' => 'author_id',
			'value' => '$data->author->fullName',
		],
		'text',
		[
			'name' => 'date',
			'filter' => 'С ' . datePicker($this, 'from_date') . 'До ' . datePicker($this, 'to_date'),
		],
		array(
			'class'=>'CButtonColumn',
		),
	),
));


