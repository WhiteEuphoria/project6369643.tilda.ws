<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FraudClaimResource\Pages;
use App\Models\FraudClaim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Пользователь')
                    ->searchable()
                    ->required(),
                Forms\Components\Textarea::make('details')
                    ->label('Описание')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->label('Статус')
                    ->options([
                        'В рассмотрении' => 'В рассмотрении',
                        'Одобрено' => 'Одобрено',
                        'Отклонено' => 'Отклонено',
                    ])
                    ->default('В рассмотрении')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Пользователь')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('details')
                    ->label('Описание')
                    ->limit(60)
                    ->wrap(),
                Tables\Columns\tExtColumn::make('status')
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
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFraudClaims::route('/'),
            'create' => Pages\CreateFraudClaim::route('/create'),
            'edit' => Pages\EditFraudClaim::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool
    {
        return false;
    }

}
