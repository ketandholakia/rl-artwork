<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\PlateResource\Pages;
use App\Filament\Resources\PlateResource\RelationManagers;
use App\Models\Plate;
use App\Models\Media;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;





class PlateResource extends Resource
{
    protected static ?string $model = Plate::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Artworks';

    protected static ?string $recordTitleAttribute = 'remark';

    
    public static function getGloballySearchableAttributes(): array
{
    return ['plateno', 'remark'];
}


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('plateno')->required(),
                TextInput::make('run')->required()->default(0),
                TextInput::make('challanno'),
                DatePicker::make('challandate'),

                Select::make('year')
                ->options([
                    '2017' => '2017',
                    '2018' => '2018',
                    '2019' => '2019',
                    '2020' => '2020',
                    '2021' => '2021',
                    '2022' => '2022',
                    '2022' => '2022',
                    '2023' => '2023',
                    
                ])->default('2023')->required(),


                

                Select::make('plates_media_id')
                    ->label('Media')
                    ->options(Media::all()->pluck('mediatype', 'id')),
                    
                    
                TextInput::make('remark'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('plateno')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('challano'),
                TextColumn::make('challandate'),
                TextColumn::make('remark')->searchable(),
                TextColumn::make('run'),
                TextColumn::make('media.mediatype'),
                
                TextColumn::make('updated_at')->sortable(),
                TextColumn::make('created_at')->sortable(),
            ])
            ->filters([
                SelectFilter::make('year')
                ->options([
                    '2017' => '2017',
                    '2018' => '2018',
                    '2019' => '2019',
                    '2020' => '2020',
                    '2021' => '2021',
                    '2022' => '2022',
                    '2022' => '2022',
                    '2023' => '2023',
                ]),
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])->defaultSort('plateno', 'asc');

            
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ArtworksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlates::route('/'),
            'create' => Pages\CreatePlate::route('/create'),
            'edit' => Pages\EditPlate::route('/{record}/edit'),
        ];
    }
}
