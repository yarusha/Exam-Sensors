<?php
namespace App\Classes\Requests\Validators;
/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.12.2022
 * Time: 16:48
 */
class GetSensorsValidator
{
    public function getRulesCreateSensor() : array {
        return [
            'name'=>['required','string','min:1'],
            'count_params'=>['required','integer','min:1']
        ];
    }

    public function getRulesUpdateSensor() : array {
        return [
            'count_params'=>['required_without:name','integer','min:1'],
            'name'=>['required_without:count_params','string','min:1'],
        ];
    }

    public function getRulesCreateSensorParams() : array {
        return [
            'value'=>['required','numeric','min:1'],
        ];
    }
}
