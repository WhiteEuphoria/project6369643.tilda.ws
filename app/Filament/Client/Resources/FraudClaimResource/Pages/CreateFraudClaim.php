<?php

namespace App\Filament\Client\Resources\FraudClaimResource\Pages;

use App\Filament\Client\Resources\FraudClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateFraudClaim extends CreateRecord
{
    protected static string $resource = FraudClaimResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
 
        return $data;
    }
}
