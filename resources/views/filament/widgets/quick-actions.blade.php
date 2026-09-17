<x-filament-widgets::widget>
    <section class="admin-quick-actions">
        <div class="admin-quick-actions__copy">
            <h2 class="admin-quick-actions__title">Quick actions</h2>
            <p class="admin-quick-actions__intro">Common tasks for content, loans, and customer follow-up.</p>
        </div>
        <div class="admin-quick-actions__list">
            @foreach ($actions as $action)
                <a
                    href="{{ $action['url'] }}"
                    class="admin-quick-actions__button {{ $action['primary'] ? 'is-primary' : 'is-secondary' }}"
                >
                    {{ $action['label'] }}
                </a>
            @endforeach
        </div>
    </section>
</x-filament-widgets::widget>
