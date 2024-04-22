<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class positions extends Model
{
    use HasFactory;
    protected $table = 'positions';
    
    protected $fillable = [
        'name', 
        'description'
    ];
    
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function candidates():HasMany
    {
        return $this->hasMany(Candidate::class);
    }
    

}
