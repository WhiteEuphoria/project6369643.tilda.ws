<?php
namespace App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms; use Filament\Forms\Form; use Filament\Resources\RelationManagers\RelationManager; use Filament\Tables; use Filament\Tables\Table;
class WithdrawalsRelationManager extends RelationManager {
    protected static string $relationship = 'withdrawals';
    public function form(Form $form): Form {
        return $form->schema([
            Forms\Components\TextInput::make('amount')->numeric()->prefix('€')->required(),
            Forms\Components\Textarea::make('requisites')->required()->columnSpanFull(),
            // Use English status values for consistency
            Forms\Components\Select::make('status')->options([
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ])->required(),
        ]);
    }
    public function table(Table $table): Table {
        return $table->recordTitleAttribute('requisites')->columns([
            Tables\Columns\TextColumn::make('amount')->money('EUR'),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->formatStateUsing(fn (string $state) => match ($state) {
                    'В обработке' => 'Pending',
                    'Выполнено', 'approve' => 'Approved',
                    'Отклонено' => 'Rejected',
                    default => ucfirst($state),
                })
                ->color(fn (string $state): string => match ($state) {
                    'pending', 'В обработке' => 'warning',
                    'approved', 'Выполнено', 'approve' => 'success',
                    'rejected', 'Отклонено' => 'danger',
                    default => 'gray',
                }),
        ])->headerActions([Tables\Actions\CreateAction::make()])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }
}
