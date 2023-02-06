<?php

namespace App\Filament\Resources;

use App\Models\Cylinder;
use App\Filament\Resources\FlatbedDieResource\Pages;
use App\Filament\Resources\FlatbedDieResource\RelationManagers;
use App\Models\FlatbedDie;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;



class FlatbedDieResource extends Resource
{
    protected static ?string $model = FlatbedDie::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Dies';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('flatbeddies_cylinder_id')
                    ->label('Teeth')
                    ->options(Cylinder::all()->pluck('teeth', 'id'))
                    ->searchable(),


                TextInput::make('customermark'),
                TextInput::make('aroundsize')->numeric(),
                TextInput::make('acrosssize')->numeric(),
                TextInput::make('aroundrepeat')->numeric(),
                TextInput::make('acrossrepeat')->numeric(),
                TextInput::make('aroundgap')->numeric(),
                TextInput::make('acrossgap')->numeric(),
                TextInput::make('cornerradius')->numeric(),
                TextInput::make('media'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFlatbedDies::route('/'),
            'create' => Pages\CreateFlatbedDie::route('/create'),
            'edit' => Pages\EditFlatbedDie::route('/{record}/edit'),
        ];
    }
}