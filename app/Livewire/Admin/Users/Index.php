<?php

namespace App\Livewire\Admin\Users;

use App\Concerns\Livewire\Admin\HasAdminList;
use App\Concerns\Livewire\Admin\HasAdminModal;
use App\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Contracts\View\View;

class Index extends AdminComponent
{
    use HasAdminList;
    use HasAdminModal;

    protected function exportModule(): string
    {
        return 'users';
    }

    /**
     * @return list<string>
     */
    protected function sortable(): array
    {
        return ['id', 'name', 'email', 'created_at'];
    }

    public function deleteConfirmed(): void
    {
        $user = User::query()->findOrFail($this->deletingId);

        abort_if($user->is(auth()->user()), 403);

        $user->delete();
        $this->cancelDelete();
        $this->dispatch('toast', type: 'success', message: __('Deleted'));
    }

    public function render(): View
    {
        $users = User::query()
            ->when($this->search, function ($query): void {
                $query->where(function ($nested): void {
                    $nested->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id')
            ->paginate(12);

        return $this->page('livewire.admin.users.index', __('Admin users'), [
            'users' => $users,
            'modalRecord' => $this->modalId ? User::query()->find($this->modalId) : null,
        ]);
    }
}
