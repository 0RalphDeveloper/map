<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['plant_id', 'event_type', 'event_date', 'status'];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
