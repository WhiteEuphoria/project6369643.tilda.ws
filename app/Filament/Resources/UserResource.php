<?php
namespace App\Filament\Resources;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User; use Filament\Forms; use Filament\Forms\Form; use Filament\Resources\Resource; use Filament\Tables; use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash; use Filament\Pages\Page; use Illuminate\Database\Eloquent\Model;
class UserResource extends Resource {
    protected static ?string $model = User::class; protected static ?string $navigationIcon = 'heroicon-o-users';
    public static function form(Form $form): Form {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\TextInput::make('password')->password()->dehydrateStateUsing(fn (string $state): string => Hash::make($state))->dehydrated(fn (?string $state): bool => filled($state))->required(fn (Page $livewire): bool => $livewire instanceof Pages\CreateUser),
            Forms\Components\TextInput::make('main_balance')->numeric()->prefix('€')->required(),
            Forms\Components\Select::make('verification_status')->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])->required(),
            Forms\Components\Toggle::make('is_admin')->required(),
        ]);
    }
    public static function table(Table $table): Table {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(), Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\IconColumn::make('is_admin')->boolean(), Tables\Columns\TextColumn::make('main_balance')->money('EUR')->sortable(),
            Tables\Columns\TextColumn::make('verification_status')->badge()->color(fn (string $state): string => match ($state) { 'pending' => 'warning', 'approved' => 'success', 'rejected' => 'danger', }),
        ])->actions([ Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()->visible(fn (Model $record): bool => $record->id !== 1), ]);
    }
    public static function getRelations(): array {
        return [
            RelationManagers\AccountsRelationManager::class,
            RelationManagers\FraudClaimsRelationManager::class,
            RelationManagers\WithdrawalsRelationManager::class,
            RelationManagers\DocumentsRelationManager::class,
        ];
    }
    public static function getPages(): array { return [ 'index' => Pages\ListUsers::route('/'), 'create' => Pages\CreateUser::route('/create'), 'edit' => Pages\EditUser::route('/{record}/edit'), ]; }
}
