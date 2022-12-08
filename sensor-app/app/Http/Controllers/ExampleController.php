<?php

namespace App\Http\Controllers;
use App\Models\Sensor\Sensors;
class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Sensors $sensors
    )
    {
//        phpinfo();
//        dd($sensors->insert(['name' => 'test', 'count_params'=>10]));
        dd($sensors->where('id', 1)->first()->toArray());
    }

    public function test() {
        return ['TEST'=>333];

    }

    //
}
