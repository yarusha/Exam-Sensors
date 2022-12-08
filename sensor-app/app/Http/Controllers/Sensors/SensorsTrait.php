<?php
declare(strict_types=1);

namespace App\Http\Controllers\Sensors;
use Illuminate\Support\Arr;

/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.12.2022
 * Time: 17:10
 */
trait SensorsTrait
{
    /**
     * @var array
     */
    private array $data;

    private float $value;
    /**
     * @param array $data
     */
    private function initParams(array $data) {
        $this->value = (int)Arr::get($data, 'value', 0);
        $this->data = $data;
    }
}
