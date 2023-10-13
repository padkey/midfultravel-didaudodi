<?php

namespace DDDD\Blog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pages
 * @package DTV\blog\Models
 */
class Locale extends Model
{
    protected $table = 'locale';
    protected $fillable = ['name','code'];
    const COL_ID = "id";
    const COL_NAME = "name";
    const COL_CODE = "code";

}
