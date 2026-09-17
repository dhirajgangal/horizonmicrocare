<div
    x-data="{
        toasts: [],
        add(toast) {
            const item = { id: Date.now() + Math.random(), type: toast.type || 'success', message: toast.message };
            this.toasts.push(item);
            setTimeout(() => this.remove(item.id), 5000);
        },
        remove(id) {
            this.toasts = this.toasts.filter((toast) => toast.id !== id);
        },
    }"
    x-init="@if (session('toast')) add(@js(session('toast'))) @endif"
    @toast.window="add($event.detail)"
    class="toast-stack"
    aria-live="polite"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div :class="toast.type === 'danger' ? 'toast-card is-danger' : 'toast-card is-success'">
            <div class="flex items-start gap-3 px-4 py-3">
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-navy" x-text="toast.type === 'danger' ? {{ Illuminate\Support\Js::from(__('Something went wrong')) }} : {{ Illuminate\Support\Js::from(__('Saved')) }}"></p>
                    <p class="mt-0.5 text-sm text-text-2" x-text="toast.message"></p>
                </div>
                <button type="button" class="text-text-2 hover:text-navy" @click="remove(toast.id)" aria-label="{{ __('Dismiss') }}">
                    ×
                </button>
            </div>
        </div>
    </template>
</div>
