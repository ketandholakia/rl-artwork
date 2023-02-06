<?php

namespace App\Filament\Resources\ArtworkResource\Pages;

use App\Filament\Resources\ArtworkResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\ImportField;

class ListArtworks extends ListRecords
{
    protected static string $resource = ArtworkResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->fields([
                    ImportField::make('artworks_order_id')
                        ->label('artworks_order_id')
                        ->helperText('Define as artworks_order_id '),
                    
                        ImportField::make('description')
                        ->label('description')
                        ->helperText('Define as description '),
                        
                        ImportField::make('requiredqty')
                        ->label('requiredqty')
                        ->helperText('Define as requiredqty '),

                        ImportField::make('priority')
                        ->label('priority')
                        ->helperText('Define as priority '),

                        ImportField::make('awstatus')
                        ->label('awstatus')
                        ->helperText('Define as awstatus '),
                ])

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return ArtworkResource::getWidgets();
    }
}
