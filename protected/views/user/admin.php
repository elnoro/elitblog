<?php
Yii::app()->getClientScript()->registerScript('openRemoteForm', '
	window.openRemoteForm = function(url)
	{
		$("#remote_form_dialog").load(url, {}, function () {
			$("#remote_form_dialog").dialog("open");
		});
	}

	window.openRemoteFormOnClick = function(event)
	{
		openRemoteForm($(this).attr("href"));
		return false;
	}

	$("body").on("click", ".button-column .update", openRemoteFormOnClick);
');

Yii::app()->getClientScript()->registerScript('submitRemoteForm', '
	$("body").on("submit", "#user-form", function (event) {
		$form = $("#user-form");
		$.post(
			$form.attr("action"),
			$form.serializeArray(),
			function (data) {
				$("#remote_form_dialog").html(data);
				$.fn.yiiGridView.update("user-grid");
			},
			"html"
		);
		return false;
	});
');
?>
<h1>Список пользователей</h1>

<?php echo CHtml::htmlButton(
	'Создать пользователя',
	['onclick' => "openRemoteForm('" . Yii::app()->createUrl('user/create') . "')"]
); ?>
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
)); 

$this->widget('zii.widgets.jui.CJuiDialog',array(
    'id' => 'remote_form_dialog',
    'options' => array(
        'title'   => 'Форма',
        'autoOpen'=> false,
        'width' => 'auto',
    ),
));
