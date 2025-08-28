<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AccountsRelationManager extends RelationManager
{
    protected static string $relationship = 'accounts';

    protected static ?string $title = 'Invoices';

    public function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Наименование')
                    ->default(fn ($record) => $record->type === 'Транзитный' ? 'Транзитный' : $record->name),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\TextColumn::make('balance')->money('EUR'),
                Tables\Columns\TextColumn::make('status')->badge(),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make()->url(fn ($record) => \App\Filament\Resources\AccountResource::getUrl('edit', ['record' => $record])),
            ])
            ->bulkActions([]);
    }
}
