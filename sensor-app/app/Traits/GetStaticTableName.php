<?php
/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 03.01.2020
 * Time: 13:26
 */

namespace App\Traits;


trait GetStaticTableName
{
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}