<?php

namespace App\Filament\Client\Resources\WithdrawalResource\Pages;

use App\Filament\Client\Resources\WithdrawalResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateWithdrawal extends CreateRecord
{
    protected static string $resource = WithdrawalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
 
        return $data;
    }
}
