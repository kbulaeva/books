<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;

?>

<p style="text-align: right;">
    <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div>

    <?= $this->render('_filters', [
        'model' => $books,
        'authors' => $authors
    ]); ?>

</div>

<?php
    Modal::begin([
        'header' => '<h4>Просмотр книги</h4>',
        'id' => 'book-modal',
        'size' => 'modal-lg'
    ]);
?>
<div id='book-modal-content'></div>
<?php

    Modal::end();
?>

<?php
    Modal::begin([
        'header' => '<h4>Просмотр картинки</h4>',
        'id' => 'image-modal',
    ]);
?>
<img id='image-modal-content' src="" style="max-width: 100%;"></img>
<?php

    Modal::end();
?>

<?php

echo \yii\grid\GridView::widget([
    'id' => 'services-grid',

    'dataProvider' => $dataProvider,

    'tableOptions' => ['class' => 'table table-bordered'],

    'layout' => '<div class="GridViewSummary">{summary}</div><br/><div class="panel panel-default"><div class="table-responsive">{items}</div><div class="table-footer">{pager}</div></div>',

    'columns' => [
        'id',
        'name',
        [
            'attribute' => 'preview',
            'content' => function($data) {
                return Html::img($data->preview, [
                    'style' => 'width:120px;',
                    'class' => 'preview-image'
                ]);
            }
        ],
        [
            'attribute' => 'author_id',
            'content' => function($data) {
                return $data->author->fullname;
            }
        ],
        [
            'attribute' => 'date',
            'content' => function($data) {
                return Yii::$app->formatter->asDate($data->date);
            }
        ],
        [
            'attribute' => 'date_create',
            'content' => function($data) {
                return $data->dateCreateText;
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {view} {delete}',
            'buttons' => [
                'update' => function ($url, $model) use ($filters) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-pencil"></span>',
                    $url . '&filters=' . $filters);
                },
                'view' => function ($url, $model) use ($filters) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-eye-open grid-view-action"></span>',
                    $url);
                },
                'delete' => function ($url, $model) use ($filters) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-trash"></span>',
                    $url . '&filters=' . $filters);
                },
            ],
        ],
    ],
]);

?>