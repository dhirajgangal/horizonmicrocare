<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Inquiries\InquiryResource;
use App\Filament\Resources\LoanApplications\LoanApplicationResource;
use App\Filament\Resources\LoanProducts\LoanProductResource;
use App\Models\Inquiry;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class DashboardTables extends TableWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.dashboard-tables';

    public string $activeTab = 'applications';

    public function setActiveTab(string $tab): void
    {
        if (! in_array($tab, ['applications', 'inquiries', 'products'], true)) {
            return;
        }

        $this->activeTab = $tab;
        $this->resetTable();
    }

    public function table(Table $table): Table
    {
        return match ($this->activeTab) {
            'inquiries' => $this->inquiriesTable($table),
            'products' => $this->productsTable($table),
            default => $this->applicationsTable($table),
        };
    }

    /**
     * @return array<string, int>
     */
    public function tabCounts(): array
    {
        return [
            'applications' => Schema::hasTable('loan_applications') ? LoanApplication::query()->count() : 0,
            'inquiries' => Schema::hasTable('inquiries') ? Inquiry::query()->count() : 0,
            'products' => Schema::hasTable('loan_products') ? LoanProduct::query()->count() : 0,
        ];
    }

    private function applicationsTable(Table $table): Table
    {
        return $table
            ->heading('Recent loan applications')
            ->description('Latest applications submitted through the platform.')
            ->query(fn (): Builder => LoanApplication::query()->with('loanProduct')->latest()->limit(5))
            ->columns([
                TextColumn::make('reference'),
                TextColumn::make('applicant_name')
                    ->label('Applicant'),
                TextColumn::make('loanProduct.name')
                    ->label('Product')
                    ->placeholder('—'),
                TextColumn::make('requested_amount')
                    ->label('Amount')
                    ->money('INR')
                    ->placeholder('—'),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->since(),
            ])
            ->paginated(false)
            ->headerActions([
                Action::make('viewAll')
                    ->label('View all applications')
                    ->url(LoanApplicationResource::getUrl('index'))
                    ->color('primary'),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->url(fn (LoanApplication $record): string => LoanApplicationResource::getUrl('view', ['record' => $record])),
            ])
            ->emptyStateHeading('No loan applications yet')
            ->emptyStateDescription('Submitted applications will appear here.');
    }

    private function inquiriesTable(Table $table): Table
    {
        return $table
            ->heading('Recent inquiries')
            ->description('Latest customer enquiries waiting for a response.')
            ->query(fn (): Builder => Inquiry::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('subject')
                    ->placeholder('General enquiry'),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->since(),
            ])
            ->paginated(false)
            ->headerActions([
                Action::make('viewAll')
                    ->label('View all inquiries')
                    ->url(InquiryResource::getUrl('index'))
                    ->color('primary'),
            ])
            ->emptyStateHeading('No inquiries yet')
            ->emptyStateDescription('Customer inquiries will appear here.');
    }

    private function productsTable(Table $table): Table
    {
        return $table
            ->heading('Loan products overview')
            ->description('Products and the number of applications attached to each.')
            ->query(fn (): Builder => LoanProduct::query()->withCount('applications'))
            ->columns([
                TextColumn::make('name')
                    ->sortable(),
                TextColumn::make('applications_count')
                    ->label('Applications')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->defaultSort('name')
            ->paginated(false)
            ->headerActions([
                Action::make('viewAll')
                    ->label('View all products')
                    ->url(LoanProductResource::getUrl('index'))
                    ->color('primary'),
            ])
            ->emptyStateHeading('No loan products found')
            ->emptyStateDescription('Add a loan product to see it here.');
    }
}
