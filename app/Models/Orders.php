<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $guarded = ['id'];

    protected $table = "orders";

    protected $fillable = [
       'start_coordinates','end_coordinates','distance'
    ];
}