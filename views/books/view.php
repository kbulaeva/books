<?php
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
<?php Pjax::begin(['id' => 'view-book']) ?>
<div class="view-row">
    <label><?php echo $model->getAttributeLabel('id'); ?>:</label>
    <span><?php echo $model->id; ?></span>
</div>
<div class="view-row">
    <label><?php echo $model->getAttributeLabel('name'); ?>:</label>
    <span><?php echo $model->name; ?></span>
</div>
<div class="view-row">
    <label><?php echo $model->getAttributeLabel('author_id'); ?>:</label>
    <span><?php echo $model->author->fullname; ?></span>
</div>
<div class="view-row">
    <label><?php echo $model->getAttributeLabel('date'); ?>:</label>
    <span><?php echo Yii::$app->formatter->asDate($model->date); ?></span>
</div>
<div class="view-row">
    <label><?php echo $model->getAttributeLabel('preview'); ?>:</label></br>
    <?php echo Html::img($model->preview, [
        'style' => 'max-width: 80%;',
    ]); ?>
</div>
<div class="view-row">
    <label><?php echo $model->getAttributeLabel('date_create'); ?>:</label>
    <span><?php echo Yii::$app->formatter->asDate($model->date_create); ?></span>
</div>
<div class="view-row">
    <label><?php echo $model->getAttributeLabel('date_update'); ?>:</label>
    <span><?php echo Yii::$app->formatter->asDate($model->date_update); ?></span>
</div>
<?php Pjax::end() ?>