<?php

namespace App\Filament\Resources\FraudClaimResource\Pages;

use App\Filament\Resources\FraudClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFraudClaim extends EditRecord
{
    protected static string $resource = FraudClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
