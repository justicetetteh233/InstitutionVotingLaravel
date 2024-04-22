<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $fillable=[
        'name',
        'pictureUrl',
        'positions_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function position():BelongsTo
    {
        return $this->belongsTo(positions::class,'positions_id');
    }

}
