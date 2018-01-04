<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @since  0.1.0
     * @var  array  $fillable  Larik dari kolom data yang diisikan.
     */
    public $fillable = array(
        'name',
        'title'
    );
}
