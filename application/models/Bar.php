<?php

namespace application\models;

use vendor\components\Model;

class Bar extends Model
{
    public $bar_beer = [];

    public function tableName()
    {
        return 'bar';
    }

    public function rule()
    {
        return [
            ['name', 'required'],
            ['coord', 'required'],
        ];
    }
}