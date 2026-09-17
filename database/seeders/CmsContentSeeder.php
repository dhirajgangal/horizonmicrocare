<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Enums\CmsPageType;
use App\Enums\InquiryStatus;
use App\Enums\PublishStatus;
use App\Models\ClientStory;
use App\Models\CmsPage;
use App\Models\Faq;
use App\Models\GalleryCategory;
use App\Models\HomeSection;
use App\Models\HomeSlide;
use App\Models\HomeStatistic;
use App\Models\HowItWorksStep;
use App\Models\Inquiry;
use App\Models\LeadershipMember;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use App\Models\NavigationItem;
use App\Models\WhyChooseUsItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsContentSeeder extends Seeder
{
    public function run(): void
    {
        HomeSlide::query()->firstOrCreate(
            ['title' => 'Demo homepage slide'],
            [
                'subtitle' => 'Placeholder content for review only.',
                'image_path' => 'images/logo-rectangle.png',
                'status' => PublishStatus::Draft,
                'sort_order' => 1,
            ],
        );

        HomeStatistic::query()->firstOrCreate(
            ['label' => 'Communities served'],
            [
                'value' => 'To be published',
                'helper_text' => 'Demo placeholder. Official figures will replace this.',
                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        HomeSection::query()->firstOrCreate(
            ['heading' => 'Women-focused financial inclusion'],
            [
                'kicker' => 'Our work',
                'body' => '<p>Demo section. Replace with approved organization copy.</p>',
                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        WhyChooseUsItem::query()->firstOrCreate(
            ['title' => 'Community first'],
            [
                'description' => 'Demo item. Add the organization\'s own reasons here.',
                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        HowItWorksStep::query()->firstOrCreate(
            ['title' => 'Enquire'],
            [
                'description' => 'Demo step. Describe the actual enquiry process.',
                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        DB::table('cms_pages')
            ->whereIn('slug', ['about', 'mission', 'vision', 'values'])
            ->orWhereIn('type', ['about', 'mission', 'vision', 'values'])
            ->delete();

        foreach ([
            ['Privacy Policy', 'privacy-policy', CmsPageType::Legal],
            ['Terms & Conditions', 'terms', CmsPageType::Legal],
            ['Disclaimer', 'disclaimer', CmsPageType::Legal],
            ['Grievance Redressal', 'grievance', CmsPageType::Legal],
        ] as [$title, $slug, $type]) {
            CmsPage::query()->firstOrCreate(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'type' => $type,
                    'excerpt' => 'Demo page. Replace with approved content.',
                    'body' => '<p>This is placeholder copy for the Super Admin review. It is not an official statement.</p>',
                    'status' => PublishStatus::Draft,
                ],
            );
        }

        LeadershipMember::query()->firstOrCreate(
            ['name' => 'Leadership profile'],
            [
                'role_title' => 'To be published',
                'bio' => '<p>Demo leadership profile. Add the official CEO or leadership biography here.</p>',
                'is_active' => false,
                'sort_order' => 1,
            ],
        );

        $product = LoanProduct::query()->firstOrCreate(
            ['slug' => 'community-livelihood-loan'],
            [
                'name' => 'Community Livelihood Loan',
                'summary' => 'Demo product for admin review. Not an offer.',
                'description' => '<p>Placeholder loan product. Official eligibility, tenure, and charges will be published by the organization.</p>',
                'status' => PublishStatus::Draft,
                'sort_order' => 1,
            ],
        );

        $product->features()->firstOrCreate(['title' => 'Purpose-led support'], [
            'description' => 'Demo feature.',
            'sort_order' => 1,
        ]);
        $product->eligibilityItems()->firstOrCreate(['title' => 'Women applicants'], [
            'description' => 'Demo eligibility item.',
            'sort_order' => 1,
        ]);
        $product->requiredDocuments()->firstOrCreate(['title' => 'Identity proof'], [
            'description' => 'Demo document requirement.',
            'is_required' => true,
            'sort_order' => 1,
        ]);
        $product->faqs()->firstOrCreate(['question' => 'Does submitting an application guarantee a loan?'], [
            'answer' => '<p>No. This website collects information only. Approval is decided separately.</p>',
            'sort_order' => 1,
        ]);

        ClientStory::query()->firstOrCreate(
            ['headline' => 'Demo client story'],
            [
                'name' => 'Sample member',
                'location' => 'To be published',
                'story' => '<p>Placeholder story labeled as demo content.</p>',
                'status' => PublishStatus::Draft,
                'sort_order' => 1,
            ],
        );

        $category = GalleryCategory::query()->firstOrCreate(
            ['slug' => 'community'],
            [
                'name' => 'Community',
                'description' => 'Demo gallery category.',
                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        $category->images()->firstOrCreate(
            ['title' => 'Demo gallery image'],
            [
                'image_path' => 'images/logo-square.png',
                'alt_text' => 'Horizonion Microcare Association logo',
                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        Faq::query()->firstOrCreate(
            ['question' => 'How can I enquire about a loan?'],
            [
                'answer' => '<p>Use the public enquiry form. A team member will respond using the contact details you provide.</p>',
                'category' => 'General',
                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        LoanApplication::query()->firstOrCreate(
            ['mobile' => '9000000000', 'applicant_name' => 'Demo Applicant'],
            [
                'loan_product_id' => $product->id,
                'email' => 'demo.applicant@example.test',
                'city' => 'Pune',
                'state' => 'Maharashtra',
                'purpose' => 'Demo application for Super Admin review.',
                'status' => ApplicationStatus::New,
            ],
        );

        Inquiry::query()->firstOrCreate(
            ['email' => 'demo.inquiry@example.test'],
            [
                'name' => 'Demo Inquirer',
                'subject' => 'Question about loan information',
                'message' => 'This is a demo enquiry created for Super Admin review.',
                'status' => InquiryStatus::New,
            ],
        );

        NavigationItem::query()->firstOrCreate(
            ['label' => 'Home', 'location' => 'header'],
            [
                'url' => '/',
                'is_active' => true,
                'sort_order' => 1,
            ],
        );
    }
}
