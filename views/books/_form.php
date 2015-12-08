<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bootui\datepicker\Datepicker;
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'validateOnChange' => false,
        'validateOnBlur' => false
    ]); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => 120]); ?>

    <?php echo $form->field($model, 'author_id')->dropDownList(
            $authors
    ); ?>

    <?php echo $form->field($model, 'preview')->textInput(['maxlength' => 255]); ?>

    <?php echo $form->field($model, 'date')->widget(Datepicker::className(), [
        'format' => 'yyyy-mm-dd',
        'options' => ['class' => 'field-datepicker'],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>