<?php
namespace App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms; use Filament\Forms\Form; use Filament\Resources\RelationManagers\RelationManager; use Filament\Tables; use Filament\Tables\Table;
class WithdrawalsRelationManager extends RelationManager {
    protected static string $relationship = 'withdrawals';
    public function form(Form $form): Form {
        return $form->schema([
            Forms\Components\TextInput::make('amount')->numeric()->prefix('€')->required(),
            Forms\Components\Textarea::make('requisites')->required()->columnSpanFull(),
            Forms\Components\Select::make('status')->options(['В обработке' => 'В обработке', 'Выполнено' => 'Выполнено', 'Отклонено' => 'Отклонено'])->required(),
        ]);
    }
    public function table(Table $table): Table {
        return $table->recordTitleAttribute('requisites')->columns([
            Tables\Columns\TextColumn::make('amount')->money('EUR'),
            Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                'В обработке' => 'warning', 'Выполнено' => 'success', 'Отклонено' => 'danger',
                default => 'gray',
                'approve' => 'success',
            }),
        ])->headerActions([Tables\Actions\CreateAction::make()])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }
}
