<?php

namespace App\Providers;

use App\Enums\UserStatus;
use App\Models\ClientStory;
use App\Models\CmsPage;
use App\Models\Faq;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\HomeSection;
use App\Models\HomeSlide;
use App\Models\HomeStatistic;
use App\Models\HowItWorksStep;
use App\Models\Inquiry;
use App\Models\LeadershipMember;
use App\Models\LoanApplication;
use App\Models\LoanApplicationDocument;
use App\Models\LoanEligibilityItem;
use App\Models\LoanFaq;
use App\Models\LoanFeature;
use App\Models\LoanProduct;
use App\Models\LoanRequiredDocument;
use App\Models\NavigationItem;
use App\Models\User;
use App\Models\WhyChooseUsItem;
use App\Policies\ActivityPolicy;
use App\Policies\ClientStoryPolicy;
use App\Policies\CmsPolicy;
use App\Policies\FaqPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\InquiryPolicy;
use App\Policies\LeadershipMemberPolicy;
use App\Policies\LoanApplicationDocumentPolicy;
use App\Policies\LoanApplicationPolicy;
use App\Policies\LoanProductPolicy;
use App\Policies\LoanRelatedPolicy;
use App\Policies\NavigationItemPolicy;
use App\Policies\RolePolicy;
use App\Support\RelativeSignedUploadUrl;
use App\View\Composers\PublicLayoutComposer;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Features\SupportFileUploads\GenerateSignedUploadUrl;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GenerateSignedUploadUrl::class, RelativeSignedUploadUrl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->booted(function (): void {
            $host = request()->getSchemeAndHttpHost();

            if (is_string($host) && $host !== '' && str_contains($host, '://')) {
                URL::forceRootUrl($host);
            }
        });

        View::composer([
            'layouts.public',
            'layouts.partials.*',
            'pages.*',
            'errors.*',
        ], PublicLayoutComposer::class);

        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Activity::class, ActivityPolicy::class);
        Gate::policy(HomeSlide::class, CmsPolicy::class);
        Gate::policy(HomeStatistic::class, CmsPolicy::class);
        Gate::policy(HomeSection::class, CmsPolicy::class);
        Gate::policy(WhyChooseUsItem::class, CmsPolicy::class);
        Gate::policy(HowItWorksStep::class, CmsPolicy::class);
        Gate::policy(CmsPage::class, CmsPolicy::class);
        Gate::policy(LoanProduct::class, LoanProductPolicy::class);
        Gate::policy(LoanFeature::class, LoanRelatedPolicy::class);
        Gate::policy(LoanEligibilityItem::class, LoanRelatedPolicy::class);
        Gate::policy(LoanRequiredDocument::class, LoanRelatedPolicy::class);
        Gate::policy(LoanFaq::class, LoanRelatedPolicy::class);
        Gate::policy(LoanApplication::class, LoanApplicationPolicy::class);
        Gate::policy(LoanApplicationDocument::class, LoanApplicationDocumentPolicy::class);
        Gate::policy(Inquiry::class, InquiryPolicy::class);
        Gate::policy(ClientStory::class, ClientStoryPolicy::class);
        Gate::policy(GalleryCategory::class, GalleryPolicy::class);
        Gate::policy(GalleryImage::class, GalleryPolicy::class);
        Gate::policy(Faq::class, FaqPolicy::class);
        Gate::policy(LeadershipMember::class, LeadershipMemberPolicy::class);
        Gate::policy(NavigationItem::class, NavigationItemPolicy::class);

        Gate::before(function (?User $user, string $ability): ?bool {
            return $user?->hasRole('Super Admin') ? true : null;
        });

        Event::listen(Login::class, function (Login $event): void {
            if (! $event->user instanceof User) {
                return;
            }

            if ($event->user->status !== UserStatus::Active) {
                return;
            }

            $event->user->forceFill(['last_login_at' => now()])->save();
        });
    }
}
