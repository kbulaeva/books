<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class BooksController extends Controller {

    public $layout = 'admin';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate() {
        $model = new \app\models\db\Books();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'BooksSearch' => unserialize(Yii::$app->request->get('filters'))]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'authors' => \app\models\db\Authors::getList()
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'BooksSearch' => unserialize(Yii::$app->request->get('filters'))]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'authors' => \app\models\db\Authors::getList()
            ]);
        }
    }

    public function actionView($id) {
        $model = $this->findModel($id);

        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'BooksSearch' => unserialize(Yii::$app->request->get('filters'))]);
    }

    public function actionIndex() {
        $booksFilter = new \app\models\filters\BooksSearch();
        $booksFilter->load(Yii::$app->request->get());

        $model = new \app\models\db\Books();
        $dataProvider = $model->search($booksFilter);

        return $this->render('index', array (
            'dataProvider' => $dataProvider,
            'books' => $booksFilter,
            'authors' => \app\models\db\Authors::getList(true),
            'filters' => serialize(Yii::$app->request->get('BooksSearch'))
        ));
    }

    protected function findModel($id) {
        if (($model = \app\models\db\Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не найдена.');
        }
    }

}
