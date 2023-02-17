<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;



class Artwork extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = ['description', 'artworks_order_id', 'artworks_plate_id', 'requiredqty', 'jobrun', 'labelrepeat', 'printedqty', 'remark', 'prepressstage', 'artworks_media_id', 'type', 'awstatus', 'priority', 'url'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'artworks_order_id');
    }

    public function plates(): HasMany
    {
        return $this->hasMany(Artwork::class, 'artworks_plate_id');
    }
}