<?php
namespace application\models;

use vendor\components\Model;

class Comment extends Model
{
    public function tableName()
    {
        return 'comment';
    }

    public function rule()
    {
        return [
            [['id_user', 'id_bar'], 'required'],
        ];
    }
}