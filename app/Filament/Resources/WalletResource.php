<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WalletResource\Pages;
use App\Filament\Resources\WalletResource\RelationManagers;
use App\Models\Category;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WalletResource extends Resource
{
    protected static ?string $model = Wallet::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static ?string $navigationLabel = 'Carteiras';

    protected static ?string $modelLabel = 'Carteiras';

    protected static ?string $navigationGroup = 'Administração';

    protected static ?string $slug = 'minha-carteira';

    protected static ?int $navigationSort = 1;

    /**
     * @return bool
     */
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Usuário')
                    ->description('Selecione um usuário')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Usuários')
                            ->placeholder('Selecione um usuário')
                            ->relationship(name: 'user', titleAttribute: 'name')
                            ->options(
                                fn ($get) => User::query()
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->live(),
                ]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('balance')
                            ->required()
                            ->numeric()
                            ->label('Saldo')
                            ->default(0.00),
                        Forms\Components\TextInput::make('balance_bonus')
                            ->required()
                            ->numeric()
                            ->label('Bônus')
                            ->default(0.00),
                        Forms\Components\TextInput::make('refer_rewards')
                            ->required()
                            ->numeric()
                            ->label('Comissão')
                            ->default(0.00),
                        ])->columns(2),

            ]);
    }

    /**
     * @param Table $table
     * @return Table
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuário')
                    ->sortable(),
                Tables\Columns\TextColumn::make('balance')
                    ->formatStateUsing(fn (string $state): string => \Helper::amountFormatDecimal($state))
                    ->label('Saldo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('balance_bonus')
                    ->formatStateUsing(fn (string $state): string => \Helper::amountFormatDecimal($state))
                    ->label('Bônus')
                    ->sortable(),

                Tables\Columns\TextColumn::make('refer_rewards')
                    ->formatStateUsing(fn (string $state): string => \Helper::amountFormatDecimal($state))
                    ->label('Comissão')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                //Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListWallets::route('/'),
            'create' => Pages\CreateWallet::route('/create'),
            'edit' => Pages\EditWallet::route('/{record}/edit'),
        ];
    }
}
