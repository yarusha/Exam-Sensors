<?php
namespace App\Classes\LogicalModels\Sensors;

/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.12.2022
 * Time: 16:33
 */

use Mockery\Exception;
use App\Models\Sensor\{
    Sensors, SensorParams
};

class SensorsModel
{
    public function __construct(
        private Sensors $sensors,
        private SensorParams $sensorParams
    )
    {}

    /**
     * @return array
     */
    public function getSensors() : array {
        return $this->sensors
            ->get([
                'id', 'name', 'count_params'
            ])
            ->toArray();
    }

    /**
     * @param $id
     * @return array
     */
    public function getSensor(int $id) : array {
        $result = $this->sensors
            ->where('id', $id)
            ->first([
                'id', 'name', 'count_params'
            ]);
        return $result ? $result->toArray() : throw new Exception("Sensor by id: {$id} not found", 404);
    }

    /**
     * @param $data
     * @return array
     */
    public function createSensor(array $data) : array {
        return $this->sensors
            ->create($data)
            ->toArray();
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteSensor(int $id) : bool {
        $this->sensorParams
            ->where('sensor_id', $id)
            ->delete();
        return (bool)$this->sensors
            ->where('id', $id)
            ->delete();
    }

    /**
     * @param int $id
     * @param array $data
     * @return array
     */
    public function updateSensor(int $id, array $data) : bool {
        if ($this->checkIfSensorExists($id)) {
            $result = (bool)$this->sensors
                ->where('id', $id)
                ->update($data);
            $this->clearParamsIfNeededBySensorId($id);
            return $result;
        }
        throw new \Exception('Sensor id: {$id} not found', 404);

    }

    /**
     * @param int $id
     * @return array
     */
    private function getSensorParamsById(int $id) : array {
        return $this->sensorParams
            ->where('sensor_id', $id)
            ->get([
                'value'
            ])
            ->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getSensorWithParamsById(int $id) : array {
        return $this->getSensor($id) + ['params'=>$this->getSensorParamsById($id)];
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getSensorParamsOrException(int $id) : array {
        $result = $this->sensorParams
            ->where('sensor_id', $id)
            ->get([
                'value'
            ]);
        return $result ? $result->toArray() : throw new \Exception("Sensor params id {$id} not found", 404);
    }

    /**
     * @param int $id
     * @param $value
     * @return array|bool
     * @throws \Exception
     */
    public function createSensorParams(int $id, $value) : bool {
        if ($this->checkIfSensorExists($id)) {
            $result = (bool)$this->sensorParams
                ->create([
                    'sensor_id' => $id,
                    'value' => $value
                ]);
            $this->clearParamsIfNeededBySensorId($id);
            return $result;
        }
        throw new \Exception('Sensor id: {$id} not found', 404);
    }

    /**
     * @param int $id
     * @return bool
     */
    private function clearParamsIfNeededBySensorId(int $id) : void {
        $sensorData = $this->getSensor($id);
        $countParams = $this->getCountSensorParams($id);
        if ($sensorData['count_params'] <= $countParams)
            $this->sensorParams
                ->whereIn('id', function ($query) use ($id, $countParams, $sensorData) {
                    $query->select('id')
                        ->from($this->sensorParams->getTable())
                        ->where('sensor_id', $id)
                        ->orderBy('id')
                        ->limit($countParams - $sensorData['count_params']);
                })
                ->delete();
    }

    /**
     * @param int $id
     * @return bool
     */
    private function checkIfSensorExists(int $id) : bool {
        return (bool)$this->sensors
            ->where('id', $id)
            ->first();
    }

    /**
     * @param int $id
     * @return int
     */
    private function getCountSensorParams(int $id) : int {
        return $this->sensorParams
            ->where('sensor_id', $id)
            ->count();
    }
}
