<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    protected $fillable = ['header_image', 'color_menu', 'color_action', 'color_footer', 'color_copyright', 'publish'];

}
