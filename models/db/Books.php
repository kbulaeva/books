<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class Books extends ActiveRecord {

    public static function tableName() {
        return 'books';
    }

    public function rules() {
        return [
            [['name', 'author_id'], 'required'],
            [['id', 'author_id'], 'integer'],
            [['name', 'date_create', 'date_update', 'preview', 'date'], 'string']
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Дата создания',
            'date_update' => 'Дата обновления',
            'preview' => 'Превью книги',
            'date' => 'Дата выхода книги',
            'author_id' => 'Автор'
        ];
    }

    public function getAuthor() {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    public function getDateCreateText() {
        if ($this->date_create > date('Y-m-d 00:00:00')) {
            return 'Сегодня';
        } elseif ($this->date_create > date('Y-m-d 00:00:00', time() - 86400)) {
            return 'Вчера';
        }

        return \Yii::$app->formatter->asDate($this->date_create);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $date = date('Y-m-d H:i:s', time());

            if ($insert) {
                $this->date_create = $date;
            }

            $this->date_update = $date;

            return true;
        } else {
            return false;
        }
    }

    public function search($params) {
        $query = self::find()->joinWith(['author']);

        $query->all();

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'author_id' => [
                    'asc' => ['firstname' => SORT_ASC, 'lastname' => SORT_ASC],
                    'desc' => ['firstname' => SORT_DESC, 'lastname' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'date',
                'date_create'
            ]
        ]);

        if ($params->author_id) {
            $query->andFilterWhere([
                'author_id' => $params->author_id
            ]);
        }

        if ($params->name) {
            $query->andFilterWhere(['like', 'name', $params->name]);
        }

        if ($params->fromDate && $params->toDate) {
            $fromDate = split('/', $params->fromDate);
            $fromDate = $fromDate[2] . '-' . $fromDate[1] . '-' . $fromDate[0];

            $toDate = split('/', $params->toDate);
            $toDate = $toDate[2] . '-' . $toDate[1] . '-' . $toDate[0];

            $query->andFilterWhere(['between', 'date', $fromDate, $toDate]);
        }

        return $dataProvider;
    }
}