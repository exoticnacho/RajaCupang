<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatus extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->icon('heroicon-o-clock')
                ->description('Pesanan yang belum diproses'),
                
            Stat::make('Completed Orders', Order::where('status', 'selesai')->count())
                ->icon('heroicon-o-check-circle')
                ->description('Pesanan yang telah selesai'),

            Stat::make('Cancelled Orders', Order::where('status', 'dibatalkan')->count())
                ->icon('heroicon-o-x-circle')
                ->description('Pesanan yang dibatalkan'),
        ];
    }
}
