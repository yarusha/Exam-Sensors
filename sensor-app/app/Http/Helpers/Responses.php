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
        http_response_code($code);
        return [
            'status' => 'error',
            'message' => $message
        ];
    }
}
