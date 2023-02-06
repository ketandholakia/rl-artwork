<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Customer;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\OrderResource\Widgets\StatsOverview;




class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-list';
    protected static ?string $navigationGroup = 'Artworks';
    protected static ?string $recordTitleAttribute = 'orderno';


    public static function form(Form $form): Form
    {   
      
        return $form
            ->schema([
                TextInput::make('orderno')->required(),

                Select::make('orders_customer_id')
                    ->label('Customer')
                    ->options(Customer::all()->pluck('name', 'id'))
                    
                    ->required(),

                Select::make('status')
                    ->options([
                        'neworder' => 'New Order',
                        'inprocess' => 'In Process',
                        'noartwork' => 'No Artworks',
                        'approved' => 'Approved',
                        'cancelled' => 'Cancelled',
                        'printed' => 'Printed',
                        'delivered' => 'Delivered',
                        'preprocessdone' => 'Preprocess Done',
                        'approvalpending' => 'Approval Pending',

                    ])->required()->default('neworder'),

                    Select::make('priority')
                    ->options([
                        'high' => 'High',
                        'medium' => 'Medium',
                        'low' => 'Low',

                    ])->default('medium'),

                    TextInput::make('url'),
                    TextInput::make('id'),






            ]);

        
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('orderno')
                    ->searchable()
                    ->sortable()
                    ->label('Order No'),
                TextColumn::make('customer.name'),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'neworder',
                        'success' => 'inprocess',
                        'warning' => 'noartwork',
                        'success' => 'approved',
                        'warning' => 'cancelled',
                        'success' => 'printed',
                        'warning' => 'delivered',
                        'success' => 'approvalpending',
                        'success' => 'preprocessdone',
                    ])->searchable()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->sortable(),

                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->tooltip('Filter by this Customer')
                    ->disableClick()
                    ->extraAttributes(function (Order $record) {
                        return [
                            'wire:click' => '$set("tableFilters.orders_customer_id.values", ['. $record->orders_customer_id .'])',
                            

                            'class' => 'transition hover:text-primary-500 cursor-pointer',

                            // http://rl.loc/orders?tableSortColumn=updated_at&tableSortDirection=desc&tableFilters[orders_customer_id][value]=8
                            // http://rl.loc/orders?tableSortColumn=updated_at&tableSortDirection=desc&tableFilters[orders_customer_id][value]=8
                            // http://rl.loc/orders?tableSortColumn=updated_at&tableSortDirection=desc&tableFilters[orders_customer_id][vaule][0]=8
                            // http://rl.loc/orders?tableSortColumn=updated_at&tableSortDirection=desc&tableFilters[orders_customer_id][vaule]=8
                            // http://rl.loc/orders?tableSortColumn=updated_at&tableSortDirection=desc&tableFilters[orders_customer_id][values][0]=8
                            // http://rl.loc/orders?tableSortColumn=updated_at&tableSortDirection=desc&tableFilters[orders_customer_id][vaule][0]=8
                            // http://rl.loc/orders?tableSortColumn=updated_at&tableSortDirection=desc&tableFilters[orders_customer_id][0]=8
                        ];
                    }),


                // 'neworder','inprocess','noartwork','approved','cancelled','printed','delivered'

                TextColumn::make('url')->html(),



            ])->defaultSort('updated_at', 'desc')

            ->filters([
                SelectFilter::make('orders_customer_id')->relationship('customer', 'name'),
                SelectFilter::make('status')
                    ->options([
                        'neworder' => 'New Order',
                        'inprocess' => 'In Process',
                        'noartwork' => 'No Artworks',
                        'approved' => 'Approved',
                        'cancelled' => 'Cancelled',
                        'printed' => 'Printed',
                        'delivered' => 'Delivered',
                        'preprocessdone' => 'Preprocess Done',
                        'approvalpending' => 'Approval Pending',
                    ]),


            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                FilamentExportBulkAction::make('export'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ArtworksRelationManager::class,

        ];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}