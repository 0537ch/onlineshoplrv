<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Shop';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    TextInput::make('order_number')
                        ->required()
                        ->maxLength(255)
                        ->disabled(),
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->required()
                        ->searchable(),
                    TextInput::make('total_amount')
                        ->required()
                        ->numeric()
                        ->prefix('$')
                        ->disabled(),
                    Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'processing' => 'Processing',
                            'completed' => 'Completed',
                            'cancelled' => 'Cancelled',
                        ])
                        ->required()
                        ->default('pending'),
                    TextInput::make('shipping_address')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('shipping_city')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('shipping_postal_code')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('shipping_phone')
                        ->required()
                        ->tel()
                        ->maxLength(255),
                    Textarea::make('notes')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Card::make()
                ->schema([
                    Placeholder::make('Order Items')
                        ->content(function (Order $record): string {
                            $items = $record->items()->with('product')->get();
                            $content = '';
                            foreach ($items as $item) {
                                $content .= "• {$item->product->name} - Qty: {$item->quantity} - Price: \${$item->price}\n";
                            }
                            return $content;
                        })
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->money()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'processing',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }
}
