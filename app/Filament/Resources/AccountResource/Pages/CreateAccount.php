<?php

namespace App\Filament\Resources\AccountResource\Pages;

use App\Filament\Resources\AccountResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAccount extends CreateRecord
{
    protected static string $resource = AccountResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If account type is Transit and 'name' is empty,
        // set a sensible default.
        if (isset($data['type']) && $data['type'] === 'Транзитный' && empty($data['name'])) {
            $data['name'] = 'Transit Account';
        }

        // If 'status' is empty, default to 'Active' for all account types
        // to satisfy database requirements.
        if (empty($data['status'])) {
            $data['status'] = 'Active';
        }

        return $data;
    }
}
