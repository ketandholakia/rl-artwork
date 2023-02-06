<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Orders', Order::count()),
            Card::make('New Order', Order::whereIn('status', ['neworder'])->count()),
            Card::make('Completed', Order::whereIn('status', ['preprocessdone'])->count()),
            Card::make('Approval Pending', Order::whereIn('status', ['approvalpending'])->count()),
            Card::make('Approved', Order::whereIn('status', ['approved'])->count()),
        ];
    }
}