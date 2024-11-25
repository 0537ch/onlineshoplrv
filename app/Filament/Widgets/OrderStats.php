<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::count())
                ->description('Total semua pesanan')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),
            
            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->description('Pesanan yang belum diproses')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            
            Stat::make('Completed Orders', Order::where('status', 'delivered')->count())
                ->description('Pesanan yang sudah selesai')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            
            Stat::make('Total Revenue', function () {
                $total = Order::where('status', 'delivered')
                    ->sum('total_amount');
                return 'Rp ' . number_format($total, 0, ',', '.');
            })
                ->description('Pendapatan dari pesanan selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}
