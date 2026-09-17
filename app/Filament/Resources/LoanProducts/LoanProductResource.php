<?php

namespace App\Filament\Resources\LoanProducts;

use App\Enums\NavigationGroup;
use App\Filament\Resources\LoanProducts\Pages\CreateLoanProduct;
use App\Filament\Resources\LoanProducts\Pages\EditLoanProduct;
use App\Filament\Resources\LoanProducts\Pages\ListLoanProducts;
use App\Filament\Resources\LoanProducts\Pages\ViewLoanProduct;
use App\Filament\Resources\LoanProducts\RelationManagers\EligibilityItemsRelationManager;
use App\Filament\Resources\LoanProducts\RelationManagers\FaqsRelationManager;
use App\Filament\Resources\LoanProducts\RelationManagers\FeaturesRelationManager;
use App\Filament\Resources\LoanProducts\RelationManagers\RequiredDocumentsRelationManager;
use App\Filament\Resources\LoanProducts\Schemas\LoanProductForm;
use App\Filament\Resources\LoanProducts\Schemas\LoanProductInfolist;
use App\Filament\Resources\LoanProducts\Tables\LoanProductsTable;
use App\Models\LoanProduct;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LoanProductResource extends Resource
{
    protected static ?string $model = LoanProduct::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::LoanManagement;

    protected static ?string $navigationLabel = 'Loan Products';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return LoanProductForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LoanProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LoanProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            FeaturesRelationManager::class,
            EligibilityItemsRelationManager::class,
            RequiredDocumentsRelationManager::class,
            FaqsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLoanProducts::route('/'),
            'create' => CreateLoanProduct::route('/create'),
            'view' => ViewLoanProduct::route('/{record}'),
            'edit' => EditLoanProduct::route('/{record}/edit'),
        ];
    }
}
