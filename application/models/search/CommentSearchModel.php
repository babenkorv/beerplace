<?php

namespace application\models\search;

use application\models\Comment;

class CommentSearchModel extends Comment
{
    private function screening($string)
    {
        return (!empty($string) || is_numeric($string)) ? '"' . $string . '"' : '';
    }

    public function search($findData)
    {
        $this->where('email_user', '=', $this->screening($findData['email_user']))
            ->andWhere('is_active', '=', $this->screening($findData['is_active']))
            ->andWhere('id_bar', '=', $this->screening($findData['id_bar']));
        return $this;
    }
}