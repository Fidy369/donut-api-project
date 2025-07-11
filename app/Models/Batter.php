<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batter extends Model
{
    protected $fillable = ['api_id', 'type', 'donut_id'];

    public function donut()
    {
        return $this->belongsTo(Donut::class);
    }
}
