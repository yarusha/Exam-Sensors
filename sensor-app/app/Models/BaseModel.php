<?php
declare(strict_types=1);

namespace App\Models;
use App\Traits\GetStaticTableName;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.12.2022
 * Time: 15:29
 */
class BaseModel extends Model
{
    use GetStaticTableName;
    public $timestamps = false; // no ORM custom timestamps fields in table
    public $guarded = ['disable_this_feature']; // disables mass assignment protection
    protected $rules = array();// validation rules
    protected $messages = array();// validation messages
    protected $errors;
}
