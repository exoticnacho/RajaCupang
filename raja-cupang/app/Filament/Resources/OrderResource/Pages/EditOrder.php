<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // Override form() untuk tambahkan field status
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('status')
                ->label('Status Pesanan')
                ->options([
                    'pending' => 'Pending',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                ])
                ->required(),
        ];
    }
}
