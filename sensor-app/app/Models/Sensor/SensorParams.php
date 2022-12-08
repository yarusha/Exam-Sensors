<?php
declare(strict_types=1);

namespace App\Models\Sensor;
use App\Models\BaseModel;

/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.12.2022
 * Time: 17:06
 */
class SensorParams extends BaseModel
{
    protected $connection = 'sensors-api';
    protected $table = 'sensors_params';
}
