<?php
namespace App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms; use Filament\Forms\Form; use Filament\Resources\RelationManagers\RelationManager; use Filament\Tables; use Filament\Tables\Table;
class FraudClaimsRelationManager extends RelationManager {
    protected static string $relationship = 'fraudClaims';
    public function form(Form $form): Form {
        return $form->schema([
            Forms\Components\Textarea::make('details')->label('Description')->required()->columnSpanFull(),
            Forms\Components\Select::make('status')->options([
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ])->required(),
        ]);
    }
    public function table(Table $table): Table {
        return $table->recordTitleAttribute('details')->columns([
            Tables\Columns\TextColumn::make('details')->label('Description')->limit(50),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->formatStateUsing(fn (string $state) => match ($state) {
                    'В рассмотрении' => 'Pending',
                    'Одобрено' => 'Approved',
                    'Отклонено' => 'Rejected',
                    default => ucfirst($state),
                }),
        ])->headerActions([Tables\Actions\CreateAction::make()])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }
}
