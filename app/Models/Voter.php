<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class Voter extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;
    
    protected $table ='voters';

    protected $fillable =[
        'name',
        'password',
        'email'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
