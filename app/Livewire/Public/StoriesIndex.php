<?php

namespace App\Livewire\Public;

use App\Models\ClientStory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class StoriesIndex extends Component
{
    public int $visible = 6;

    public function loadMore(): void
    {
        $this->visible += 6;
    }

    public function render(): View
    {
        $total = ClientStory::query()->published()->count();

        return view('livewire.public.stories-index', [
            'stories' => ClientStory::query()->published()->limit($this->visible)->get(),
            'hasMore' => $this->visible < $total,
        ]);
    }
}
