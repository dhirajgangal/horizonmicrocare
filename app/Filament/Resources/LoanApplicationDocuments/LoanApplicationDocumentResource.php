<?php

namespace App\Filament\Resources\LoanApplicationDocuments;

use App\Enums\NavigationGroup;
use App\Filament\Resources\LoanApplicationDocuments\Pages\CreateLoanApplicationDocument;
use App\Filament\Resources\LoanApplicationDocuments\Pages\EditLoanApplicationDocument;
use App\Filament\Resources\LoanApplicationDocuments\Pages\ListLoanApplicationDocuments;
use App\Filament\Resources\LoanApplicationDocuments\Pages\ViewLoanApplicationDocument;
use App\Filament\Resources\LoanApplicationDocuments\Schemas\LoanApplicationDocumentForm;
use App\Filament\Resources\LoanApplicationDocuments\Schemas\LoanApplicationDocumentInfolist;
use App\Filament\Resources\LoanApplicationDocuments\Tables\LoanApplicationDocumentsTable;
use App\Models\LoanApplicationDocument;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LoanApplicationDocumentResource extends Resource
{
    protected static ?string $model = LoanApplicationDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPaperClip;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::LoanManagement;

    protected static ?string $navigationLabel = 'Application Documents';

    protected static ?int $navigationSort = 11;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return LoanApplicationDocumentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LoanApplicationDocumentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LoanApplicationDocumentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLoanApplicationDocuments::route('/'),
            'create' => CreateLoanApplicationDocument::route('/create'),
            'view' => ViewLoanApplicationDocument::route('/{record}'),
            'edit' => EditLoanApplicationDocument::route('/{record}/edit'),
        ];
    }
}
