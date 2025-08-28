<?php
namespace App\Filament\Resources;
use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
            Forms\Components\FileUpload::make('path')
                ->label('Document File')
                ->disk('public')
                ->directory('documents')
                ->required()
                ->storeFileNamesIn('original_name'),
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.name')->sortable(),
            Tables\Columns\TextColumn::make('original_name')->label('File Name')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\Action::make('download')
                ->label('Download')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn (Document $record): string => url('storage/' . $record->path), shouldOpenInNewTab: true),
        ]);
    }
    public static function getPages(): array
    {
        return ['index' => Pages\ListDocuments::route('/'), 'create' => Pages\CreateDocument::route('/create'), 'edit' => Pages\EditDocument::route('/{record}/edit')];
    }
}
