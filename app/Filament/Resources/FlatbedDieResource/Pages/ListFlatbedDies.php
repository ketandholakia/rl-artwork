<?php

namespace App\Filament\Resources\FlatbedDieResource\Pages;

use App\Filament\Resources\FlatbedDieResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFlatbedDies extends ListRecords
{
    protected static string $resource = FlatbedDieResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
