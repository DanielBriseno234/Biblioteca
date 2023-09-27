<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Administrator extends Model
{
    use HasFactory;
    
    protected $table = 'admin';

    protected $fillable = [
        'name',
        'paternalSurname',
        'maternalSurname',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
