<?php
namespace App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';
    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('path')
                ->label('Document File')
                ->disk('public')
                ->directory('documents')
                ->required()
                ->storeFileNamesIn('original_name'),
        ]);
    }
    public function table(Table $table): Table
    {
        return $table->recordTitleAttribute('path')->columns([
            Tables\Columns\TextColumn::make('original_name')->label('File Name'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])->headerActions([
            Tables\Actions\CreateAction::make(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\Action::make('download')
                ->label('Download')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn (Document $record): string => url('storage/' . $record->path), shouldOpenInNewTab: true),
        ]);
    }
}
