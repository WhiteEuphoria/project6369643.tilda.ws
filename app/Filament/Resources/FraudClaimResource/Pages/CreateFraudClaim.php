<?php

namespace App\Filament\Resources\FraudClaimResource\Pages;

use App\Filament\Resources\FraudClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFraudClaim extends CreateRecord
{
    protected static string $resource = FraudClaimResource::class;
}
