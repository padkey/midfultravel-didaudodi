<?php

namespace DDDD\Blog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pages
 * @package DTV\blog\Models
 */
class Block extends Model
{
    protected $table = 'block';

    const COL_ID = "id";
    const COL_TITLE = "title";
    const COL_CODE = "code";
    const COL_CONTENT = "content";
    const COL_IMAGE_ONE = "image_one";
    const COL_IMAGE_TWO = "image_two";
    const COL_TYPE = "type";

}
