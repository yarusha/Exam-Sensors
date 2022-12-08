<?php
namespace App\Http\Controllers\Sensors;
use App\Http\Controllers\Controller;
use App\Classes\LogicalModels\Sensors\SensorsModel;
use Illuminate\Http\Request;
use App\Classes\Requests\Validators\GetSensorsValidator;
use App\Http\Helpers\Responses;
/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.12.2022
 * Time: 16:20
 */
class SensorsController extends Controller
{
    use SensorsTrait;
    public function __construct(
        private SensorsModel $sensorsModel,
        private GetSensorsValidator $validator
    )
    {}

    /**
     * @return array
     */
    public function getSensors() {
        return $this->sensorsModel->getSensors();
    }

    /**
     * @param $id
     * @return array
     */
    public function getSensor($id) {
        try {
            return $this->sensorsModel->getSensorWithParamsById($id);
        } catch (\Exception $e) {
            return Responses::badResponse($e->getMessage(), $e->getCode());
        }
    }

    public function deleteSensor($id) {
        return ['result'=>$this->sensorsModel->deleteSensor($id)];
    }
    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createSensor(Request $request) {
        $this->validate($request, $this->validator->getRulesCreateSensor());
        return $this->sensorsModel->createSensor($request->all());
    }

    public function updateSensor(Request $request, $id) {
        $this->initParams(
            $this->validate($request, $this->validator->getRulesUpdateSensor())
        );
        try {
            return ['result' => $this->sensorsModel->updateSensor($id, $this->data)];
        } catch (\Exception $e) {
            return Responses::badResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getSensorParams($id) {
        try {
            return $this->sensorsModel->getSensorParamsOrException($id);
        } catch (\Exception $e) {
            return Responses::badResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|bool|string[]
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createSensorParams(Request $request, $id) {
        $this->initParams(
            $this->validate($request, $this->validator->getRulesCreateSensorParams())
        );
        try {
            return ['result'=>$this->sensorsModel->createSensorParams($id, $this->value)];
        } catch (\Exception $e) {
            return Responses::badResponse($e->getMessage(), $e->getCode());
        }

    }
}
