<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class Authors extends ActiveRecord {

    public static function tableName() {
        return 'authors';
    }

    public function rules() {
        return [
            [['firstname', 'lastname'], 'required'],
            [['id'], 'integer'],
            [['firstname', 'lastname'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
        ];
    }

    public function getBooks() {
        return $this->hasMany(Books::className(), ['author_id' => 'id']);
    }

    public function getFullname() {
        return $this->firstname . ' ' . $this->lastname;
    }

    public static function getList($all = false) {
        $options = array ();

        if ($all) {
            $options[0] = 'Все авторы';
        }

        $authors = self::find()->orderBy('lastname, firstname')->all();

        foreach ($authors as $author) {
            $options[$author->id] = $author->fullname;
        }

        return $options;
    }
}