<?php

namespace App\Filament\Resources\LoanApplications\Pages;

use App\Filament\Actions\ExportCsvAction;
use App\Filament\Resources\LoanApplications\LoanApplicationResource;
use App\Models\LoanApplication;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLoanApplications extends ListRecords
{
    protected static string $resource = LoanApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportCsvAction::make(
                'export',
                fn () => LoanApplication::query()->with('loanProduct'),
                [
                    'reference' => 'Reference',
                    'applicant_name' => 'Applicant',
                    'email' => 'Email',
                    'mobile' => 'Mobile',
                    'loanProduct.name' => 'Product',
                    'status' => 'Status',
                    'created_at' => 'Submitted',
                ],
                'loan-applications.csv',
            )->visible(fn (): bool => auth()->user()?->can('applications.export') ?? false),
            CreateAction::make(),
        ];
    }
}
