<?php

namespace app\models\filters;

use Yii;
use yii\base\Model;

class BooksSearch extends Model
{
    public $author_id;
    public $name;
    public $fromDate;
    public $toDate;

    public function __construct($sender = null, $params = null) {
        parent::__construct($sender, $params);

        $this->toDate = date('d/m/Y');

        $this->fromDate = date('d/m/Y', time() - 7 * 86400);
    }

    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['name', 'fromDate', 'toDate'], 'string'],
            ['author', 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'author_id' => 'Автор',
            'name' => 'Название книги',
            'fromDate' => 'с',
            'toDate' => 'по'
        ];
    }
}
