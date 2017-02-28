<?php

namespace application\models;

use vendor\components\Model;

class BarHasBeer extends Model
{
    public function tableName()
    {
        return 'bar_has_beer';
    }

    public function rule()
    {
        return [
            [['id_bar', 'id_beer'], 'required'],
        ];
    }
}