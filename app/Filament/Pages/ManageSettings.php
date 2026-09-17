<?php

namespace App\Filament\Pages;

use App\Enums\NavigationGroup;
use App\Services\SiteSettings;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

/**
 * @property-read Schema $form
 */
class ManageSettings extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::WebsiteSettings;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'General Settings';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->can('settings.manage') ?? false;
    }

    public function getTitle(): string|Htmlable
    {
        return 'Website Settings';
    }

    public function mount(): void
    {
        $this->form->fill(app(SiteSettings::class)->all());
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Settings')
                    ->persistTabInQueryString()
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                TextInput::make('general.company_name')
                                    ->label('Company name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('general.tagline')
                                    ->maxLength(255),
                                Textarea::make('general.short_description')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Branding')
                            ->schema([
                                FileUpload::make('branding.logo_rectangle')
                                    ->label('Rectangle logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('images')
                                    ->visibility('public')
                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'])
                                    ->maxSize(2048),
                                FileUpload::make('branding.logo_square')
                                    ->label('Square logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('images')
                                    ->visibility('public')
                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'])
                                    ->maxSize(2048),
                                FileUpload::make('branding.favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->disk('public')
                                    ->directory('images')
                                    ->visibility('public')
                                    ->acceptedFileTypes(['image/png', 'image/x-icon', 'image/vnd.microsoft.icon', 'image/svg+xml'])
                                    ->maxSize(512),
                            ]),
                        Tab::make('Contact')
                            ->schema([
                                TextInput::make('contact.phone')->tel(),
                                TextInput::make('contact.email')->email(),
                                TextInput::make('contact.whatsapp'),
                                Textarea::make('contact.address')->rows(3)->columnSpanFull(),
                                TextInput::make('contact.office_hours')->columnSpanFull(),
                                Textarea::make('contact.map_embed')
                                    ->label('Map embed or URL')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Social')
                            ->schema([
                                TextInput::make('social.facebook')->url()->maxLength(255),
                                TextInput::make('social.instagram')->url()->maxLength(255),
                                TextInput::make('social.linkedin')->url()->maxLength(255),
                                TextInput::make('social.twitter')->url()->maxLength(255),
                                TextInput::make('social.youtube')->url()->maxLength(255),
                            ]),
                        Tab::make('Footer & SEO')
                            ->schema([
                                TextInput::make('footer.copyright')->columnSpanFull(),
                                Textarea::make('footer.legal_text')->rows(3)->columnSpanFull(),
                                TextInput::make('seo.default_title')->label('Default SEO title'),
                                Textarea::make('seo.default_description')->label('Default meta description')->rows(3)->columnSpanFull(),
                                FileUpload::make('seo.default_og_image')
                                    ->label('Default Open Graph image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('images')
                                    ->visibility('public'),
                            ]),
                        Tab::make('Consent')
                            ->schema([
                                Textarea::make('consent.text')
                                    ->label('Application consent text')
                                    ->rows(5)
                                    ->columnSpanFull(),
                                TextInput::make('consent.version')
                                    ->label('Consent version')
                                    ->maxLength(20),
                            ]),
                    ]),
            ]);
    }

    public function save(): void
    {
        $settings = app(SiteSettings::class);
        $settings->setMany($this->flattenSettings($this->form->getState()));

        activity()
            ->causedBy(auth()->user())
            ->event('updated')
            ->log('Admin updated website settings');

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Public website configuration')
                    ->description('These values appear on the public site immediately after you save.')
                    ->schema([
                        $this->getFormContentComponent(),
                    ]),
            ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function flattenSettings(array $data, string $prefix = ''): array
    {
        $flat = [];

        foreach ($data as $key => $value) {
            $fullKey = $prefix === '' ? (string) $key : $prefix.'.'.$key;

            if (is_array($value) && $value !== [] && ! array_is_list($value)) {
                $flat = [...$flat, ...$this->flattenSettings($value, $fullKey)];

                continue;
            }

            if (is_array($value) && array_is_list($value)) {
                $flat[$fullKey] = $value[0] ?? null;

                continue;
            }

            $flat[$fullKey] = $value;
        }

        return $flat;
    }

    public function getFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make([
                    Action::make('save')
                        ->label('Save settings')
                        ->submit('save')
                        ->keyBindings(['mod+s']),
                ])->alignment(Alignment::Start)->key('form-actions'),
            ]);
    }
}
