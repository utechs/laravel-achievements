<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'type', 'points'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimeStamps();
    }
}
