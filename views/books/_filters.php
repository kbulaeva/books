<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bootui\datepicker\Datepicker;
?>

<?php $form = ActiveForm::begin([
    'method' => 'get',
    'validateOnChange' => false,
    'validateOnBlur' => false,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => '{input}',
    ],
]); ?>

<div>

    <div class="row">
        <?php echo $form->field($model, 'author_id')->dropDownList(
                $authors
        ); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'name')->textInput(['maxlength' => 120, 'placeholder' => $model->getAttributeLabel('name')]); ?>
    </div>
</div>

<div style="clear: both;">
    <div class="row">
        <span style="line-height: 32px;">Дата выхода книги</span>
    </div>
    <div class="row">
        <?php echo $form->field($model, 'fromDate')->widget(Datepicker::className(), [
            'format' => 'dd/mm/yyyy',
            'options' => ['class' => 'field-datepicker'],
            'placeholder' => $model->getAttributeLabel('fromDate')
        ]); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'toDate')->widget(Datepicker::className(), [
            'format' => 'dd/mm/yyyy',
            'options' => ['class' => 'field-datepicker'],
            'placeholder' => $model->getAttributeLabel('toDate')
        ]); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>