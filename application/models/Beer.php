<?php

namespace application\models;

use vendor\components\Model;

class Beer extends Model
{
    public function tableName()
    {
        return 'beer';
    }

    public function rule()
    {
        return [
            ['name', 'required'],
        ];
    }
}