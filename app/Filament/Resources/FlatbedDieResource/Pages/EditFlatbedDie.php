<?php

namespace App\Filament\Resources\FlatbedDieResource\Pages;

use App\Filament\Resources\FlatbedDieResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFlatbedDie extends EditRecord
{
    protected static string $resource = FlatbedDieResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
