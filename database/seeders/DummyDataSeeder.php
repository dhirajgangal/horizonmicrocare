<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Enums\CmsPageType;
use App\Enums\InquiryStatus;
use App\Enums\PublishStatus;
use App\Enums\UserStatus;
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
use App\Models\User;
use App\Models\WhyChooseUsItem;
use App\Services\SiteSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    public function run(SiteSettings $settings): void
    {
        $this->seedStaffUsers();
        $this->seedSettings($settings);
        $this->seedHomeContent();
        $this->seedCmsPages();
        $this->seedLeadership();
        $products = $this->seedLoanProducts();
        $this->seedClientStories();
        $this->seedGallery();
        $this->seedFaqs();
        $this->seedApplications($products);
        $this->seedInquiries();
        $this->seedNavigation();
    }

    private function seedStaffUsers(): void
    {
        $staff = [
            ['name' => 'Anita Content', 'email' => 'content@horizonmicrocare.test', 'mobile' => '9876500101', 'role' => 'Content Manager'],
            ['name' => 'Leela Loans', 'email' => 'loans@horizonmicrocare.test', 'mobile' => '9876500102', 'role' => 'Loan Manager'],
            ['name' => 'Ravi Support', 'email' => 'support@horizonmicrocare.test', 'mobile' => '9876500103', 'role' => 'Customer Support'],
            ['name' => 'Meera Viewer', 'email' => 'viewer@horizonmicrocare.test', 'mobile' => '9876500104', 'role' => 'Viewer'],
        ];

        foreach ($staff as $member) {
            $user = User::query()->updateOrCreate(
                ['email' => $member['email']],
                [
                    'name' => $member['name'],
                    'mobile' => $member['mobile'],
                    'password' => 'password',
                    'status' => UserStatus::Active,
                    'email_verified_at' => now(),
                    'last_login_at' => now()->subDays(rand(1, 12)),
                ],
            );

            $user->syncRoles([$member['role']]);
        }
    }

    private function seedSettings(SiteSettings $settings): void
    {
        $settings->setMany([
            'contact.phone' => '+91 20 4000 1200',
            'contact.email' => 'hello@horizonmicrocare.test',
            'contact.whatsapp' => '+91 98765 00000',
            'contact.address' => '3rd Floor, Community Hub, Kothrud, Pune, Maharashtra 411038',
            'contact.office_hours' => 'Monday to Friday, 10:00 AM – 5:30 PM',
            'social.facebook' => 'https://facebook.com/horizonmicrocare',
            'social.instagram' => 'https://instagram.com/horizonmicrocare',
            'social.linkedin' => 'https://linkedin.com/company/horizonmicrocare',
            'social.youtube' => 'https://youtube.com/@horizonmicrocare',
        ]);
    }

    private function seedHomeContent(): void
    {
        foreach ([
            [
                'title' => 'Loans that support women-led livelihoods',
                'subtitle' => 'Clear information, community review, and no guaranteed approval.',
                'primary_cta_label' => 'Apply for a Loan',
                'primary_cta_url' => '/apply',
                'secondary_cta_label' => 'See offerings',
                'secondary_cta_url' => '/loans',
                'status' => PublishStatus::Published,
                'published_at' => now()->subDays(20),
                'sort_order' => 1,
            ],
            [
                'title' => 'A trusted process from enquiry to decision',
                'subtitle' => 'Track what happens after you submit details to the association.',
                'primary_cta_label' => 'How it works',
                'primary_cta_url' => '/how-it-works',
                'secondary_cta_label' => 'Contact us',
                'secondary_cta_url' => '/contact',
                'status' => PublishStatus::Published,
                'published_at' => now()->subDays(10),
                'sort_order' => 2,
            ],
            [
                'title' => 'Draft seasonal campaign',
                'subtitle' => 'This slide stays unpublished until the communications team approves it.',
                'primary_cta_label' => 'Learn more',
                'primary_cta_url' => '/about-us',
                'status' => PublishStatus::Draft,
                'published_at' => null,
                'sort_order' => 3,
            ],
        ] as $slide) {
            HomeSlide::query()->updateOrCreate(
                ['title' => $slide['title']],
                [
                    ...$slide,
                    'image_path' => 'images/logo-rectangle.png',
                    'mobile_image_path' => 'images/logo-square.png',
                ],
            );
        }

        foreach ([
            ['label' => 'Women members supported', 'value' => '1,240', 'helper_text' => 'Demo figure for review only.', 'sort_order' => 1],
            ['label' => 'Villages reached', 'value' => '48', 'helper_text' => 'Placeholder coverage number.', 'sort_order' => 2],
            ['label' => 'Livelihood groups', 'value' => '36', 'helper_text' => 'Self-help and producer groups.', 'sort_order' => 3],
            ['label' => 'Average review time', 'value' => '12 days', 'helper_text' => 'From complete application to decision.', 'sort_order' => 4],
        ] as $statistic) {
            HomeStatistic::query()->updateOrCreate(
                ['label' => $statistic['label']],
                [...$statistic, 'is_active' => true],
            );
        }

        foreach ([
            [
                'heading' => 'Designed around women entrepreneurs',
                'kicker' => 'Who we serve',
                'body' => '<p>Horizonion Microcare helps women access livelihood finance information with transparent steps and local review. This copy is dummy content for Super Admin testing.</p>',
                'cta_label' => 'Our mission',
                'cta_url' => '/our-mission',
                'sort_order' => 1,
            ],
            [
                'heading' => 'Responsible lending, explained simply',
                'kicker' => 'Our approach',
                'body' => '<p>Fees, documents, and timelines will be published by the organization. Dummy text is shown here so the homepage section module can be reviewed.</p>',
                'cta_label' => 'Responsible lending',
                'cta_url' => '/responsible-lending',
                'sort_order' => 2,
            ],
        ] as $section) {
            HomeSection::query()->updateOrCreate(
                ['heading' => $section['heading']],
                [
                    ...$section,
                    'image_path' => 'images/logo-rectangle.png',
                    'is_active' => true,
                ],
            );
        }

        foreach ([
            ['title' => 'Women-first design', 'description' => 'Products and communication are written for women-led households and groups.', 'sort_order' => 1],
            ['title' => 'Local review', 'description' => 'Applications are reviewed by the association, not automatically approved online.', 'sort_order' => 2],
            ['title' => 'Clear documents', 'description' => 'Required papers are listed before anyone starts an application.', 'sort_order' => 3],
            ['title' => 'Grievance channel', 'description' => 'A published support path exists if something goes wrong.', 'sort_order' => 4],
        ] as $item) {
            WhyChooseUsItem::query()->updateOrCreate(
                ['title' => $item['title']],
                [...$item, 'icon' => 'heroicon-o-heart', 'is_active' => true],
            );
        }

        foreach ([
            ['title' => 'Enquire', 'description' => 'Share your details through the public form or office contact.', 'sort_order' => 1],
            ['title' => 'Submit documents', 'description' => 'Upload or bring the papers listed for the selected product.', 'sort_order' => 2],
            ['title' => 'Community review', 'description' => 'The team verifies information and may request clarifications.', 'sort_order' => 3],
            ['title' => 'Decision', 'description' => 'You receive an approved, rejected, or more-information outcome.', 'sort_order' => 4],
            ['title' => 'Support', 'description' => 'Use the grievance channel if you need help after a decision.', 'sort_order' => 5],
        ] as $step) {
            HowItWorksStep::query()->updateOrCreate(
                ['title' => $step['title']],
                [...$step, 'icon' => 'heroicon-o-check-circle', 'is_active' => true],
            );
        }
    }

    private function seedCmsPages(): void
    {
        DB::table('cms_pages')
            ->whereIn('slug', ['about', 'mission', 'vision', 'values'])
            ->orWhereIn('type', ['about', 'mission', 'vision', 'values'])
            ->delete();

        foreach ([
            ['Privacy Policy', 'privacy-policy', CmsPageType::Legal, PublishStatus::Published],
            ['Terms & Conditions', 'terms', CmsPageType::Legal, PublishStatus::Published],
            ['Disclaimer', 'disclaimer', CmsPageType::Legal, PublishStatus::Published],
            ['Grievance Redressal', 'grievance', CmsPageType::Legal, PublishStatus::Published],
            ['Responsible Lending', 'responsible-lending', CmsPageType::Legal, PublishStatus::Draft],
        ] as [$title, $slug, $type, $status]) {
            CmsPage::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'type' => $type,
                    'excerpt' => 'Dummy '.$title.' copy for Super Admin review. Replace with approved organization content.',
                    'body' => '<p>This is dummy content for <strong>'.$title.'</strong>. It is not an official public statement and should be replaced before go-live.</p><p>The association reviews every application separately. Submitting a form does not guarantee a loan.</p>',
                    'seo_title' => $title.' | Horizonion Microcare',
                    'seo_description' => 'Dummy SEO description for '.$title.'.',
                    'hero_image_path' => 'images/logo-rectangle.png',
                    'status' => $status,
                ],
            );
        }
    }

    private function seedLeadership(): void
    {
        foreach ([
            ['name' => 'Sunita Deshmukh', 'role_title' => 'Chief Executive Officer', 'sort_order' => 1, 'is_active' => true],
            ['name' => 'Kavita Patil', 'role_title' => 'Head of Livelihood Programs', 'sort_order' => 2, 'is_active' => true],
            ['name' => 'Farida Shaikh', 'role_title' => 'Grievance Officer', 'sort_order' => 3, 'is_active' => true],
            ['name' => 'Draft Board Profile', 'role_title' => 'Board Member', 'sort_order' => 4, 'is_active' => false],
        ] as $member) {
            LeadershipMember::query()->updateOrCreate(
                ['name' => $member['name']],
                [
                    ...$member,
                    'photo_path' => 'images/logo-square.png',
                    'bio' => '<p>Dummy leadership biography for '.$member['name'].'. Replace with the official profile and consent before publishing.</p>',
                ],
            );
        }
    }

    /**
     * @return array<string, LoanProduct>
     */
    private function seedLoanProducts(): array
    {
        $catalog = [
            'community-livelihood-loan' => [
                'name' => 'Community Livelihood Loan',
                'summary' => 'Working capital for women-led micro enterprises and group activities.',
                'amount_range' => '₹15,000 – ₹75,000',
                'tenure_range' => '6 – 18 months',
                'status' => PublishStatus::Published,
                'sort_order' => 1,
                'features' => ['Purpose-led support', 'Flexible repayment windows', 'Group or individual review'],
                'eligibility' => ['Women applicants', 'Local residence proof', 'Existing livelihood activity'],
                'documents' => ['Identity proof', 'Address proof', 'Bank passbook'],
            ],
            'income-generation-loan' => [
                'name' => 'Income Generation Loan',
                'summary' => 'Support for livestock, tailoring, kirana, and other income activities.',
                'amount_range' => '₹20,000 – ₹1,00,000',
                'tenure_range' => '12 – 24 months',
                'status' => PublishStatus::Published,
                'sort_order' => 2,
                'features' => ['Activity-linked use of funds', 'Field verification visit', 'Repayment aligned to cash flow'],
                'eligibility' => ['Age 21 to 58', 'Household income documentation', 'No recent default on association loans'],
                'documents' => ['Aadhaar or voter ID', 'Income proof', 'Passport photo'],
            ],
            'education-support-loan' => [
                'name' => 'Education Support Loan',
                'summary' => 'Fees and learning materials for children of member households.',
                'amount_range' => '₹10,000 – ₹40,000',
                'tenure_range' => '6 – 12 months',
                'status' => PublishStatus::Published,
                'sort_order' => 3,
                'features' => ['School or course fee purpose', 'Disbursement to institution when possible'],
                'eligibility' => ['Parent or guardian is a member', 'Admission or fee letter'],
                'documents' => ['Identity proof', 'Fee circular or admission letter'],
            ],
            'emergency-livelihood-loan' => [
                'name' => 'Emergency Livelihood Loan',
                'summary' => 'Short-term support after illness, crop loss, or sudden household shock.',
                'amount_range' => '₹8,000 – ₹30,000',
                'tenure_range' => '3 – 9 months',
                'status' => PublishStatus::Draft,
                'sort_order' => 4,
                'features' => ['Faster document checklist', 'Short tenure'],
                'eligibility' => ['Existing member preferred', 'Evidence of emergency'],
                'documents' => ['Identity proof', 'Brief written explanation'],
            ],
        ];

        $products = [];

        foreach ($catalog as $slug => $data) {
            $product = LoanProduct::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $data['name'],
                    'summary' => $data['summary'],
                    'description' => '<p>Dummy product description for <strong>'.$data['name'].'</strong>. Amounts, tenure, and charges shown here are for Super Admin testing only and are not an offer.</p>',
                    'image_path' => 'images/logo-rectangle.png',
                    'amount_range' => $data['amount_range'],
                    'tenure_range' => $data['tenure_range'],
                    'status' => $data['status'],
                    'sort_order' => $data['sort_order'],
                ],
            );

            foreach ($data['features'] as $index => $title) {
                $product->features()->updateOrCreate(
                    ['title' => $title],
                    ['description' => 'Dummy feature for review.', 'sort_order' => $index + 1],
                );
            }

            foreach ($data['eligibility'] as $index => $title) {
                $product->eligibilityItems()->updateOrCreate(
                    ['title' => $title],
                    ['description' => 'Dummy eligibility item for review.', 'sort_order' => $index + 1],
                );
            }

            foreach ($data['documents'] as $index => $title) {
                $product->requiredDocuments()->updateOrCreate(
                    ['title' => $title],
                    ['description' => 'Dummy document requirement.', 'is_required' => true, 'sort_order' => $index + 1],
                );
            }

            $product->faqs()->updateOrCreate(
                ['question' => 'Does applying for '.$data['name'].' guarantee approval?'],
                [
                    'answer' => '<p>No. The association reviews every application separately.</p>',
                    'sort_order' => 1,
                ],
            );

            $products[$slug] = $product;
        }

        return $products;
    }

    private function seedClientStories(): void
    {
        foreach ([
            ['name' => 'Savita Kale', 'location' => 'Baramati, Maharashtra', 'headline' => 'A tailoring unit that now employs two neighbours', 'status' => PublishStatus::Published, 'sort_order' => 1],
            ['name' => 'Laxmi Jadhav', 'location' => 'Satara, Maharashtra', 'headline' => 'Goat rearing helped stabilize seasonal income', 'status' => PublishStatus::Published, 'sort_order' => 2],
            ['name' => 'Nasreen Begum', 'location' => 'Solapur, Maharashtra', 'headline' => 'A kirana counter opened after group review', 'status' => PublishStatus::Published, 'sort_order' => 3],
            ['name' => 'Draft Story', 'location' => 'To be published', 'headline' => 'Story awaiting consent and legal review', 'status' => PublishStatus::Draft, 'sort_order' => 4],
        ] as $story) {
            ClientStory::query()->updateOrCreate(
                ['headline' => $story['headline']],
                [
                    ...$story,
                    'photo_path' => 'images/logo-square.png',
                    'story' => '<p>Dummy consented-style story for '.$story['name'].'. Marked as sample content for Super Admin testing. Replace with approved, consented copy.</p>',
                ],
            );
        }
    }

    private function seedGallery(): void
    {
        $categories = [
            ['name' => 'Community', 'slug' => 'community', 'description' => 'Member meetings and village events.', 'images' => ['Self-help group meeting', 'Village awareness camp']],
            ['name' => 'Livelihoods', 'slug' => 'livelihoods', 'description' => 'Income activities supported by the association.', 'images' => ['Tailoring training', 'Livestock support visit']],
            ['name' => 'Training', 'slug' => 'training', 'description' => 'Financial literacy and skill sessions.', 'images' => ['Financial literacy workshop']],
        ];

        foreach ($categories as $index => $categoryData) {
            $category = GalleryCategory::query()->updateOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ],
            );

            foreach ($categoryData['images'] as $imageIndex => $title) {
                $category->images()->updateOrCreate(
                    ['title' => $title],
                    [
                        'description' => 'Dummy gallery photo for '.$title.'.',
                        'image_path' => 'images/logo-square.png',
                        'alt_text' => $title,
                        'is_active' => true,
                        'sort_order' => $imageIndex + 1,
                    ],
                );
            }
        }
    }

    private function seedFaqs(): void
    {
        foreach ([
            ['How can I enquire about a loan?', 'Use the public enquiry form or call the published office number. A team member will respond using the contact details you provide.', 'General', 1],
            ['Does submitting an application guarantee a loan?', 'No. This website collects information only. Approval is decided separately by the association.', 'Applications', 2],
            ['What documents are usually required?', 'Identity proof, address proof, and product-specific papers listed on each loan offering.', 'Documents', 3],
            ['How long does a review take?', 'Dummy estimate: complete applications are often reviewed within 7 to 15 working days.', 'Applications', 4],
            ['Can I track my application?', 'Yes. Use the track page with your reference number and registered mobile number.', 'Applications', 5],
            ['Who handles grievances?', 'The published grievance officer listed on the support page. Dummy contact details are in Settings.', 'Support', 6],
            ['Are interest rates shown on this website?', 'Official rates will be published by the organization. Figures in dummy data are not offers.', 'General', 7],
            ['Can a family member apply on my behalf?', 'A nominated person may help complete the form, but the applicant must confirm the details.', 'Applications', 8],
        ] as [$question, $answer, $category, $sortOrder]) {
            Faq::query()->updateOrCreate(
                ['question' => $question],
                [
                    'answer' => '<p>'.$answer.'</p>',
                    'category' => $category,
                    'is_active' => true,
                    'sort_order' => $sortOrder,
                ],
            );
        }
    }

    /**
     * @param  array<string, LoanProduct>  $products
     */
    private function seedApplications(array $products): void
    {
        $admin = User::query()->where('email', 'admin@horizonmicrocare.test')->first();
        $loanManager = User::query()->where('email', 'loans@horizonmicrocare.test')->first();

        $rows = [
            ['Savita Kale', '9876501001', 'savita.kale@example.test', 'Baramati', 'community-livelihood-loan', ApplicationStatus::Approved, 35000, 2],
            ['Laxmi Jadhav', '9876501002', 'laxmi.jadhav@example.test', 'Satara', 'income-generation-loan', ApplicationStatus::UnderReview, 48000, 1],
            ['Nasreen Begum', '9876501003', 'nasreen.begum@example.test', 'Solapur', 'income-generation-loan', ApplicationStatus::New, 25000, 0],
            ['Rekha More', '9876501004', 'rekha.more@example.test', 'Pune', 'education-support-loan', ApplicationStatus::Approved, 18000, 4],
            ['Asha Pawar', '9876501005', 'asha.pawar@example.test', 'Nashik', 'community-livelihood-loan', ApplicationStatus::Rejected, 60000, 3],
            ['Sangeeta Shinde', '9876501006', 'sangeeta.shinde@example.test', 'Kolhapur', 'education-support-loan', ApplicationStatus::UnderReview, 12000, 5],
            ['Vanita Gaikwad', '9876501007', 'vanita.gaikwad@example.test', 'Ahmednagar', 'income-generation-loan', ApplicationStatus::New, 42000, 6],
            ['Meena Kamble', '9876501008', 'meena.kamble@example.test', 'Osmanabad', 'community-livelihood-loan', ApplicationStatus::Approved, 28000, 7],
            ['Jyoti Bhosale', '9876501009', 'jyoti.bhosale@example.test', 'Sangli', 'emergency-livelihood-loan', ApplicationStatus::Archived, 15000, 8],
            ['Usha Salunkhe', '9876501010', 'usha.salunkhe@example.test', 'Latur', 'education-support-loan', ApplicationStatus::Rejected, 22000, 9],
            ['Demo Applicant', '9000000000', 'demo.applicant@example.test', 'Pune', 'community-livelihood-loan', ApplicationStatus::New, 20000, 0],
        ];

        foreach ($rows as [$name, $mobile, $email, $city, $productSlug, $status, $amount, $monthsAgo]) {
            $product = $products[$productSlug] ?? $products['community-livelihood-loan'];
            $submittedAt = Carbon::now()->subMonths($monthsAgo)->subDays(rand(1, 12));

            $application = LoanApplication::query()->updateOrCreate(
                ['mobile' => $mobile],
                [
                    'loan_product_id' => $product->id,
                    'applicant_name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => 'Maharashtra',
                    'requested_amount' => $amount,
                    'purpose' => 'Dummy application for '.$product->name.'. Submitted for Super Admin testing.',
                    'status' => $status,
                    'internal_notes' => $status === ApplicationStatus::Rejected
                        ? 'Dummy note: documents were incomplete.'
                        : 'Dummy internal note. Never show this on the public site.',
                ],
            );

            $application->forceFill([
                'created_at' => $submittedAt,
                'updated_at' => $submittedAt->copy()->addDays(2),
            ])->saveQuietly();

            if (in_array($status, [ApplicationStatus::UnderReview, ApplicationStatus::Approved, ApplicationStatus::Rejected], true)) {
                $application->notes()->updateOrCreate(
                    ['body' => 'Initial document check completed.'],
                    ['user_id' => $loanManager?->id ?? $admin?->id],
                );
            }

            if ($status === ApplicationStatus::Approved) {
                $application->documents()->updateOrCreate(
                    ['title' => 'Identity proof'],
                    [
                        'file_path' => 'images/logo-square.png',
                        'original_name' => 'identity-proof.png',
                        'mime_type' => 'image/png',
                    ],
                );
            }
        }
    }

    private function seedInquiries(): void
    {
        $support = User::query()->where('email', 'support@horizonmicrocare.test')->first();

        $rows = [
            ['Priya Kulkarni', 'priya.kulkarni@example.test', '9876502001', 'Need eligibility details', InquiryStatus::New],
            ['Smita Joshi', 'smita.joshi@example.test', '9876502002', 'Question about required documents', InquiryStatus::InProgress],
            ['Anjali Desai', 'anjali.desai@example.test', '9876502003', 'Office visit timing', InquiryStatus::Resolved],
            ['Demo Inquirer', 'demo.inquiry@example.test', '9876502004', 'Question about loan information', InquiryStatus::New],
            ['Rohini Patil', 'rohini.patil@example.test', '9876502005', 'Track application help', InquiryStatus::Closed],
            ['Deepa Naik', 'deepa.naik@example.test', '9876502006', 'Education loan enquiry', InquiryStatus::InProgress],
            ['Kavita Rane', 'kavita.rane@example.test', '9876502007', 'Grievance process question', InquiryStatus::Resolved],
        ];

        foreach ($rows as $index => [$name, $email, $mobile, $subject, $status]) {
            $inquiry = Inquiry::query()->updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'mobile' => $mobile,
                    'subject' => $subject,
                    'message' => 'Dummy enquiry: '.$subject.'. Please treat this as test data for the Super Admin inquiry module.',
                    'status' => $status,
                    'internal_notes' => 'Dummy support note. Do not publish.',
                ],
            );

            $inquiry->forceFill([
                'created_at' => now()->subDays($index + 1),
                'updated_at' => now()->subDays($index),
            ])->saveQuietly();

            if ($status !== InquiryStatus::New) {
                $inquiry->notes()->updateOrCreate(
                    ['body' => 'Called the applicant and logged this dummy follow-up.'],
                    ['user_id' => $support?->id],
                );
            }
        }
    }

    private function seedNavigation(): void
    {
        $header = [
            ['Home', '/', 1],
            ['About Us', '/about-us', 2],
            ['Our Offerings', '/loans', 3],
            ['How It Works', '/how-it-works', 4],
            ['Gallery', '/gallery', 5],
            ['FAQs', '/faqs', 6],
            ['Contact Us', '/contact', 7],
        ];

        foreach ($header as [$label, $url, $order]) {
            NavigationItem::query()->updateOrCreate(
                ['label' => $label, 'location' => 'header'],
                ['url' => $url, 'is_active' => true, 'sort_order' => $order],
            );
        }

        foreach ([
            ['Privacy Policy', '/privacy-policy', 1],
            ['Terms & Conditions', '/terms', 2],
            ['Disclaimer', '/disclaimer', 3],
            ['Grievance', '/grievance', 4],
        ] as [$label, $url, $order]) {
            NavigationItem::query()->updateOrCreate(
                ['label' => $label, 'location' => 'footer'],
                ['url' => $url, 'is_active' => true, 'sort_order' => $order],
            );
        }
    }
}
