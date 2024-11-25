<?php

namespace App\Filament\Resources\CartResource\Pages;

use App\Filament\Resources\CartResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;

class ViewCart extends ViewRecord
{
    protected static string $resource = CartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Cart Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Customer'),
                        Infolists\Components\TextEntry::make('total_items')
                            ->label('Total Items'),
                        Infolists\Components\TextEntry::make('total')
                            ->money('IDR'),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->dateTime(),
                    ]),

                Infolists\Components\Section::make('Cart Items')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('items')
                            ->schema([
                                Infolists\Components\TextEntry::make('product.name'),
                                Infolists\Components\TextEntry::make('quantity'),
                                Infolists\Components\TextEntry::make('price')
                                    ->money('IDR'),
                                Infolists\Components\TextEntry::make('subtotal')
                                    ->money('IDR'),
                            ])
                            ->columns(4),
                    ]),
            ]);
    }
}
