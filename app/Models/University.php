<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'protocol',
        'ip',
        'port',
        'prefix',
        'endpoint',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
