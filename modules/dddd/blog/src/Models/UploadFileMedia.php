<?php

namespace DDDD\Blog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pages
 * @package DTV\blog\Models
 */
class UploadFileMedia extends Model
{
    protected $table = 'upload_file_media';

    const COL_ID = "id";
    const COL_TITLE = "title";
    const COL_URL_FILE = "url_file";
    const COL_FILE = "file";
    const COL_URL_KEY = "url_key";

}
