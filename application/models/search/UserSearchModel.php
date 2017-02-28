<?php

namespace application\models\search;

use application\models\User;

class UserSearchModel extends User
{
    private function screening($string)
    {
        return (!empty($string) || is_numeric($string)) ? '"' . $string . '"' : '';
    }

    public function search($findData)
    {
        $this->where('email', '=', $this->screening($findData['email']))
            ->andWhere('is_active', '=', $this->screening($findData['is_active']));
        return $this;
    }
}