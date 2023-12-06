<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $fillable = ["name","region_id","status"];
    public const STATUSES = ['active', 'inactive', 'deleted'];

    public function cities() {
        return $this->hasMany(City::class);
    }
}
