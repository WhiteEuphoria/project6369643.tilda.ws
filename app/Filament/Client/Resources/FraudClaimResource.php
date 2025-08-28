<?php

namespace App\Filament\Client\Resources;

use App\Filament\Client\Resources\FraudClaimResource\Pages;
use App\Models\FraudClaim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class FraudClaimResource extends Resource
{
    protected static ?string $model = FraudClaim::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';
    protected static ?string $modelLabel = 'Заявление о мошенничестве';
    protected static ?string $pluralModelLabel = 'Заявления о мошенничестве';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('details')
                    ->label('Опишите ситуацию')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('details')
                    ->label('Описание')
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'В рассмотрении' => 'warning',
                        'Одобрено' => 'success',
                        'Отклонено' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата подачи')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListFraudClaims::route('/'),
            'create' => Pages\CreateFraudClaim::route('/create'),
        ];
    }

    // Этот метод гарантирует, что клиент видит только свои заявки
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }
}
