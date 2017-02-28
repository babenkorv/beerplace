<?php

namespace application\models\search;

use application\models\Bar;

class BarSearchModel extends Bar
{
    private function screening($string)
    {
        return (!empty($string) || is_numeric($string)) ? '"' . $string . '"' : '';
    }

    public function search($findData)
    {
        $this->where('name', '=', $this->screening($findData['name']))
            ->andWhere('is_active', '=', $this->screening($findData['is_active']));
        return $this;
    }
}