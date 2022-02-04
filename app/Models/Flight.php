<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'code',
        'type',
        'departure_id',
        'destination_id',
        'airline_id',
        'departure_time',
        'arrival_time'
    ];

    public function airline()
    {
        return $this->hasOne(Airline::class, 'id', 'airline_id');
    }

    public function airport()
    {
        return $this->hasOne(Airport::class, 'id', 'destination_id');
    }
    
    
}
