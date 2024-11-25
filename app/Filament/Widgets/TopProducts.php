<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class TopProducts extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->select('products.*', DB::raw('COUNT(order_items.id) as total_orders'))
                    ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
                    ->groupBy('products.id')
                    ->orderByDesc('total_orders')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->circular()
                    ->stacked()
                    ->limit(1),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('price')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('in_stock')
                    ->label('Stock')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_orders')
                    ->label('Total Orders')
                    ->sortable(),
            ]);
    }
}
