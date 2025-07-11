<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donut extends Model
{
    protected $fillable = ['api_id', 'type', 'name', 'ppu'];

    public function batters()
    {
        return $this->hasMany(Batter::class);
    }

    public function toppings()
    {
        return $this->hasMany(Topping::class);
    }
}
