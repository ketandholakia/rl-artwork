<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FlatbedDie extends Model
{
    use HasFactory;
    protected $table = 'flatbeddies';

    protected $fillable  = [
        'customermark',
        'aroundsize', 'acrosssize',
        'aroundsize', 'acrosssize',
        'aroundrepeat', 'acrossrepeat',
        'aroundgap', 'acrossgap',
        'cornerradius', 'media', 'flatbeddies_cylinder_id'
    ];

    public function cylinder(): BelongsTo
    {
        return $this->belongsTo(Cylinder::class, 'flatbeddies_cylinder_id');
    }
}