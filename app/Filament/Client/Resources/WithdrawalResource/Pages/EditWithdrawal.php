<?php

namespace App\Filament\Client\Resources\WithdrawalResource\Pages;

use App\Filament\Client\Resources\WithdrawalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWithdrawal extends EditRecord
{
    protected static string $resource = WithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
