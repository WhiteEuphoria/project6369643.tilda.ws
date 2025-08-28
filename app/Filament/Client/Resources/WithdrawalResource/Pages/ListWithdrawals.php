<?php

namespace App\Filament\Client\Resources\WithdrawalResource\Pages;

use App\Filament\Client\Resources\WithdrawalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWithdrawals extends ListRecords
{
    protected static string $resource = WithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Вывод средств'),
        ];
    }
}
