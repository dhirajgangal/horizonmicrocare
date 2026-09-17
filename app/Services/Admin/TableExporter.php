<?php

namespace App\Services\Admin;

use App\Enums\ApplicationStatus;
use App\Enums\InquiryStatus;
use App\Models\ClientStory;
use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\HomeSlide;
use App\Models\Inquiry;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class TableExporter
{
    /**
     * @param  array{search?: string, sortField?: string, sortDirection?: string, status?: string}  $filters
     * @return array{headings: list<string>, rows: list<list<string>>}
     */
    public function table(string $module, array $filters = []): array
    {
        return match ($module) {
            'home-slides' => $this->map(
                $this->sorted(HomeSlide::query(), $filters, ['id', 'heading', 'sort_order', 'is_active', 'created_at'], 'heading'),
                [__('Heading'), __('Order'), __('Status'), __('Created')],
                fn (HomeSlide $slide): array => [
                    $slide->heading,
                    (string) $slide->sort_order,
                    $slide->is_active ? __('Active') : __('Hidden'),
                    $slide->created_at?->toDateTimeString() ?? '',
                ],
            ),
            'loan-products' => $this->map(
                $this->sorted(LoanProduct::query(), $filters, ['id', 'name', 'sort_order', 'is_active', 'created_at'], 'name'),
                [__('Name'), __('Short description'), __('Order'), __('Status'), __('Created')],
                fn (LoanProduct $product): array => [
                    $product->name,
                    (string) $product->short_description,
                    (string) $product->sort_order,
                    $product->is_active ? __('Active') : __('Hidden'),
                    $product->created_at?->toDateTimeString() ?? '',
                ],
            ),
            'client-stories' => $this->map(
                $this->sorted(ClientStory::query(), $filters, ['id', 'name', 'is_published', 'sort_order', 'created_at'], 'name'),
                [__('Name'), __('Location'), __('Status'), __('Created')],
                fn (ClientStory $story): array => [
                    $story->name,
                    (string) $story->location,
                    $story->is_published ? __('Published') : __('Draft'),
                    $story->created_at?->toDateTimeString() ?? '',
                ],
            ),
            'gallery' => $this->map(
                $this->sorted(GalleryImage::query(), $filters, ['id', 'label', 'is_active', 'sort_order', 'created_at'], 'label'),
                [__('Label'), __('Alt text'), __('Status'), __('Created')],
                fn (GalleryImage $image): array => [
                    $image->label,
                    $image->alt_text,
                    $image->is_active ? __('Active') : __('Hidden'),
                    $image->created_at?->toDateTimeString() ?? '',
                ],
            ),
            'faqs' => $this->map(
                $this->sorted(Faq::query(), $filters, ['id', 'question', 'category', 'is_active', 'is_featured', 'sort_order'], 'question'),
                [__('Question'), __('Category'), __('Status'), __('Featured'), __('Created')],
                fn (Faq $faq): array => [
                    $faq->question,
                    (string) $faq->category,
                    $faq->is_active ? __('Active') : __('Hidden'),
                    $faq->is_featured ? __('Yes') : __('No'),
                    $faq->created_at?->toDateTimeString() ?? '',
                ],
            ),
            'loan-applications' => $this->map(
                $this->sorted(
                    LoanApplication::query()->with('loanProduct'),
                    $filters,
                    ['id', 'full_name', 'status', 'created_at'],
                    'full_name',
                    ['full_name', 'email', 'mobile'],
                ),
                [__('Applicant'), __('Email'), __('Mobile'), __('Product'), __('Amount'), __('Status'), __('Notes'), __('Received')],
                fn (LoanApplication $application): array => [
                    $application->full_name,
                    $application->email,
                    $application->mobile,
                    $application->loanProduct?->name ?? '',
                    (string) $application->requested_amount,
                    $application->status instanceof ApplicationStatus ? $application->status->label() : (string) $application->status,
                    (string) $application->internal_notes,
                    $application->created_at?->toDateTimeString() ?? '',
                ],
            ),
            'inquiries' => $this->map(
                $this->sorted(
                    Inquiry::query(),
                    $filters,
                    ['id', 'name', 'status', 'created_at'],
                    'name',
                    ['name', 'email', 'subject'],
                ),
                [__('Name'), __('Email'), __('Subject'), __('Status'), __('Notes'), __('Received')],
                fn (Inquiry $inquiry): array => [
                    $inquiry->name,
                    $inquiry->email,
                    $inquiry->subject,
                    $inquiry->status instanceof InquiryStatus ? $inquiry->status->label() : (string) $inquiry->status,
                    (string) $inquiry->notes,
                    $inquiry->created_at?->toDateTimeString() ?? '',
                ],
            ),
            'users' => $this->map(
                $this->sorted(User::query(), $filters, ['id', 'name', 'email', 'created_at'], 'name', ['name', 'email']),
                [__('Name'), __('Email'), __('Created')],
                fn (User $user): array => [
                    $user->name,
                    $user->email,
                    $user->created_at?->toDateTimeString() ?? '',
                ],
            ),
            default => throw new InvalidArgumentException('Unknown export module.'),
        };
    }

    /**
     * @param  Builder<*>  $query
     * @param  array{search?: string, sortField?: string, sortDirection?: string, status?: string}  $filters
     * @param  list<string>  $sortable
     * @param  list<string>|null  $searchColumns
     * @return Collection<int, mixed>
     */
    private function sorted(Builder $query, array $filters, array $sortable, string $searchColumn, ?array $searchColumns = null): Collection
    {
        $search = trim((string) ($filters['search'] ?? ''));
        $sortField = in_array($filters['sortField'] ?? '', $sortable, true) ? $filters['sortField'] : 'id';
        $sortDirection = ($filters['sortDirection'] ?? 'desc') === 'asc' ? 'asc' : 'desc';
        $status = trim((string) ($filters['status'] ?? ''));

        if ($search !== '') {
            $columns = $searchColumns ?? [$searchColumn];
            $query->where(function (Builder $nested) use ($columns, $search): void {
                foreach ($columns as $index => $column) {
                    $index === 0
                        ? $nested->where($column, 'like', '%'.$search.'%')
                        : $nested->orWhere($column, 'like', '%'.$search.'%');
                }
            });
        }

        if ($status !== '') {
            $query->where('status', $status);
        }

        return $query->orderBy($sortField, $sortDirection)->orderBy('id')->get();
    }

    /**
     * @template TModel
     *
     * @param  Collection<int, TModel>  $rows
     * @param  list<string>  $headings
     * @param  callable(TModel): list<string>  $mapper
     * @return array{headings: list<string>, rows: list<list<string>>}
     */
    private function map(Collection $rows, array $headings, callable $mapper): array
    {
        return [
            'headings' => $headings,
            'rows' => $rows->map($mapper)->values()->all(),
        ];
    }
}
