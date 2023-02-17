<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;



class Order extends Model implements HasMedia

{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['orderno', 'orders_customer_id', 'status', 'priority', 'url'];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'orders_customer_id');
    }

    public function artworks(): HasMany
    {
        return $this->hasMany(Artwork::class, 'artworks_order_id');
    }
}