<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportCsvAction
{
    /**
     * @param  array<string, string>  $columns
     */
    public static function make(string $name, callable $query, array $columns, string $filename): Action
    {
        return Action::make($name)
            ->label('Export')
            ->color('gray')
            ->outlined()
            ->visible(fn (): bool => auth()->user()?->can('applications.export') || auth()->user()?->can('inquiries.export'))
            ->action(function () use ($query, $columns, $filename): StreamedResponse {
                /** @var Builder $builder */
                $builder = $query();

                return response()->streamDownload(function () use ($builder, $columns): void {
                    $handle = fopen('php://output', 'w');
                    fputcsv($handle, array_values($columns));

                    $builder->clone()->each(function ($record) use ($handle, $columns): void {
                        $row = [];

                        foreach (array_keys($columns) as $key) {
                            $row[] = data_get($record, $key);
                        }

                        fputcsv($handle, $row);
                    });

                    fclose($handle);
                }, $filename, [
                    'Content-Type' => 'text/csv',
                ]);
            });
    }
}
