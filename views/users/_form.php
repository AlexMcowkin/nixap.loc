<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

	<? echo $form->field($model, 'hidden')->hiddenInput([])->label(false); ?>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'child_name')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'parent_name')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton( ($model->isNewRecord) ? 'Save' : 'Update' , ['class' => 'btn btn-success']) ?>
        <?= Html::resetButton( 'Reset' , ['class' => 'btn btn-danger']);?>
        <?= Html::a( 'Back' , ['/users/index'], ['class' => 'btn btn-primary']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
