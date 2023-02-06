<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\ImportField;

class Plate extends Model
{
    use HasFactory;
    protected $fillable =   ['plateno', 'plates_media_id', 'run', 'remark', 'year', 'challano', 'challandate'];


    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'plates_media_id');
    }
    public function artworks(): HasMany
    {
        return $this->hasMany(Artwork::class, 'artworks_plate_id');
    }
}
