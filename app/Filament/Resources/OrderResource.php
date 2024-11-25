<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    
    protected static ?string $navigationLabel = 'Pesanan';
    
    protected static ?string $modelLabel = 'Pesanan';
    
    protected static ?string $pluralModelLabel = 'Pesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        Order::STATUS_PENDING => 'Menunggu Pembayaran',
                        Order::STATUS_PROCESSING => 'Pesanan Diproses',
                        Order::STATUS_SHIPPED => 'Dalam Pengiriman',
                        Order::STATUS_DELIVERED => 'Pesanan Diterima',
                        Order::STATUS_CANCELLED => 'Dibatalkan'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('shipping_address')
                    ->label('Alamat Pengiriman')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('shipping_phone')
                    ->label('No. Telepon')
                    ->tel()
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label('Catatan')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('No. Pesanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu Pembayaran',
                        'processing' => 'Pesanan Diproses',
                        'shipped' => 'Dalam Pengiriman',
                        'delivered' => 'Pesanan Diterima',
                        'cancelled' => 'Dibatalkan',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pesanan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        Order::STATUS_PENDING => 'Menunggu Pembayaran',
                        Order::STATUS_PROCESSING => 'Pesanan Diproses',
                        Order::STATUS_SHIPPED => 'Dalam Pengiriman',
                        Order::STATUS_DELIVERED => 'Pesanan Diterima',
                        Order::STATUS_CANCELLED => 'Dibatalkan'
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('process')
                    ->label('Proses')
                    ->icon('heroicon-o-arrow-path')
                    ->color('info')
                    ->visible(fn (Order $record): bool => $record->status === Order::STATUS_PENDING)
                    ->action(function (Order $record): void {
                        $record->update(['status' => Order::STATUS_PROCESSING]);
                        Notification::make()
                            ->title('Pesanan diproses')
                            ->success()
                            ->send();
                    }),
                Action::make('ship')
                    ->label('Kirim')
                    ->icon('heroicon-o-truck')
                    ->color('primary')
                    ->visible(fn (Order $record): bool => $record->status === Order::STATUS_PROCESSING)
                    ->action(function (Order $record): void {
                        $record->update(['status' => Order::STATUS_SHIPPED]);
                        Notification::make()
                            ->title('Pesanan dikirim')
                            ->success()
                            ->send();
                    }),
                Action::make('deliver')
                    ->label('Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Order $record): bool => $record->status === Order::STATUS_SHIPPED)
                    ->action(function (Order $record): void {
                        $record->update(['status' => Order::STATUS_DELIVERED]);
                        Notification::make()
                            ->title('Pesanan selesai')
                            ->success()
                            ->send();
                    }),
                Action::make('cancel')
                    ->label('Batalkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Order $record): bool => in_array($record->status, [Order::STATUS_PENDING, Order::STATUS_PROCESSING]))
                    ->requiresConfirmation()
                    ->action(function (Order $record): void {
                        $record->update(['status' => Order::STATUS_CANCELLED]);
                        Notification::make()
                            ->title('Pesanan dibatalkan')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
