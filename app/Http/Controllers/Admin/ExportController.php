<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminTableExport;
use App\Http\Controllers\Controller;
use App\Services\Admin\TableExporter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    /**
     * @var list<string>
     */
    private array $modules = [
        'home-slides',
        'loan-products',
        'client-stories',
        'gallery',
        'faqs',
        'loan-applications',
        'inquiries',
        'users',
    ];

    public function __invoke(Request $request, TableExporter $exporter, string $module, string $format): StreamedResponse|BinaryFileResponse|Response
    {
        abort_unless(in_array($module, $this->modules, true), 404);
        abort_unless(in_array($format, ['csv', 'xlsx', 'pdf'], true), 404);

        $table = $exporter->table($module, $request->only(['search', 'sortField', 'sortDirection', 'status']));
        $filename = $module.'-'.now()->format('Y-m-d');

        return match ($format) {
            'csv' => $this->csv($table['headings'], $table['rows'], $filename.'.csv'),
            'xlsx' => Excel::download(new AdminTableExport($table['headings'], $table['rows']), $filename.'.xlsx', ExcelFormat::XLSX),
            'pdf' => Pdf::loadView('exports.admin-table', [
                'title' => Str::headline($module),
                'headings' => $table['headings'],
                'rows' => $table['rows'],
            ])->download($filename.'.pdf'),
        };
    }

    /**
     * @param  list<string>  $headings
     * @param  list<list<string>>  $rows
     */
    private function csv(array $headings, array $rows, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($headings, $rows): void {
            $handle = fopen('php://output', 'w');

            if ($handle === false) {
                return;
            }

            fputcsv($handle, $headings);

            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
