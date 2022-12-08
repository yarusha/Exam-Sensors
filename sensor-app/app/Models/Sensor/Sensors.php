<?php
declare(strict_types=1);
namespace App\Models\Sensor;
/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.12.2022
 * Time: 15:30
 */
use App\Models\BaseModel;

class Sensors extends BaseModel
{
    protected $connection = 'sensors-api';
    protected $table = 'sensors';
}
