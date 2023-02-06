<?php

namespace App\Filament\Resources\PlateResource\Pages;

use App\Filament\Resources\PlateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\ImportField;

class ListPlates extends ListRecords
{
    protected static string $resource = PlateResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->fields([
                    ImportField::make('plateno')
                        ->label('Plate No')
                        ->helperText('Define as plate no'),
                    
                ])
        ];
    }
}
