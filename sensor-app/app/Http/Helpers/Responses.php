<?php
declare(strict_types=1);
namespace App\Http\Helpers;
/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.12.2022
 * Time: 17:39
 */
class Responses
{
    public static function badResponse(string $message, int $code = 400) {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}
