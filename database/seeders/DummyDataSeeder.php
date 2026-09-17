<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Enums\InquiryStatus;
use App\Models\ClientStory;
use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\HomeSlide;
use App\Models\Inquiry;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSlides();
        $products = $this->seedProducts();
        $this->seedStories();
        $this->seedGallery();
        $this->seedFaqs();
        $this->seedApplications($products);
        $this->seedInquiries();
    }

    private function seedSlides(): void
    {
        $slides = [
            ['image' => 'images/carousel/01.jpg', 'kicker' => 'Trust, Growth, Community', 'heading' => 'Livelihood support that starts with a conversation.', 'text' => 'Explore offerings made for women-led work. Submitting a form never guarantees a loan or approval.', 'cta_label' => 'Apply for Loan', 'cta_url' => '/apply-loan', 'sort_order' => 1],
            ['image' => 'images/carousel/02.jpg', 'kicker' => 'Women first', 'heading' => 'Ask clearly. Hear back honestly.', 'text' => 'We collect applications so the next step can be a human review, not an automatic promise.', 'cta_label' => 'Our offerings', 'cta_url' => '/our-offerings', 'sort_order' => 2],
            ['image' => 'images/carousel/03.jpg', 'kicker' => 'Community', 'heading' => 'Stories from women who asked for support.', 'text' => 'Read experiences shared in their own words. They are not forecasts of another outcome.', 'cta_label' => 'Client stories', 'cta_url' => '/client-stories', 'sort_order' => 3],
            ['image' => 'images/carousel/04.jpg', 'kicker' => 'Field notes', 'heading' => 'Photographs from the work we walk alongside.', 'text' => 'Visit the gallery, then decide whether an enquiry or application is the right next step.', 'cta_label' => 'View gallery', 'cta_url' => '/gallery', 'sort_order' => 4],
            ['image' => 'images/carousel/05.jpg', 'kicker' => 'Next step', 'heading' => 'Start an application when you are ready.', 'text' => 'Tell us about the livelihood you want to support. We will follow up if we need more information.', 'cta_label' => 'Contact us', 'cta_url' => '/contact-us', 'sort_order' => 5],
        ];

        foreach ($slides as $slide) {
            HomeSlide::query()->updateOrCreate(
                ['heading' => $slide['heading']],
                [...$slide, 'is_active' => true]
            );
        }
    }

    /**
     * @return list<LoanProduct>
     */
    private function seedProducts(): array
    {
        $items = [
            [
                'name' => 'Livelihood Starter Loan',
                'slug' => 'livelihood-starter-loan',
                'short_description' => 'For women beginning or steadying a small trade, service, or home-based activity.',
                'description' => 'This offering is for women who want to discuss support for a livelihood they already run or are preparing to start. The form on this site is only a first step.',
                'features' => ['Conversation-first review', 'Guidance on documents we may ask for', 'No promised amount or rate on this website'],
                'eligibility' => 'Typically women applicants with a livelihood purpose they can describe. Final eligibility is not decided by this website.',
                'required_documents' => "Identity proof\nAddress proof\nPhotograph\nA short note on the activity",
            ],
            [
                'name' => 'Women Enterprise Loan',
                'slug' => 'women-enterprise-loan',
                'short_description' => 'For women who already have customers and want to discuss growing the activity.',
                'description' => 'Use this offering when the work is underway and you want to talk about stock, tools, or a modest expansion. Nothing here is an offer of funds.',
                'features' => ['Suited to existing activity', 'Apply from the product page', 'Follow-up only if more detail is needed'],
                'eligibility' => 'Women who can describe current work and why additional support is being requested.',
                'required_documents' => "Identity proof\nAddress proof\nBasic activity details",
            ],
            [
                'name' => 'Agri & Allied Livelihood Loan',
                'slug' => 'agri-allied-livelihood-loan',
                'short_description' => 'For farm, livestock, or allied work led by women.',
                'description' => 'This page explains a product you can enquire about for agricultural or allied livelihoods. Seasonal details, if needed, are discussed after the form is reviewed.',
                'features' => ['For farm and allied activity', 'Plain-language application', 'No implied harvest-linked guarantee'],
                'eligibility' => 'Women engaged in or preparing farm or allied work. Review happens after submission.',
                'required_documents' => "Identity proof\nAddress proof\nActivity description",
            ],
            [
                'name' => 'Education & Skills Support Loan',
                'slug' => 'education-skills-support-loan',
                'short_description' => 'For skills or education costs connected to a woman’s livelihood path.',
                'description' => 'Ask about support for a course, tool training, or related cost. We will not treat the form as enrolment or as a promised scholarship.',
                'features' => ['Purpose must be described', 'Human follow-up', 'No automatic approval'],
                'eligibility' => 'Women who can name the skill or education purpose. This site does not confirm admission or funding.',
                'required_documents' => "Identity proof\nAddress proof\nNote on the course or skill",
            ],
        ];

        $products = [];

        foreach ($items as $index => $item) {
            $products[] = LoanProduct::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [...$item, 'is_active' => true, 'sort_order' => $index + 1]
            );
        }

        return $products;
    }

    private function seedStories(): void
    {
        $stories = [
            ['name' => 'Sunita Patil', 'photo' => 'images/clients/client-01.png', 'location' => 'Nashik, Maharashtra', 'feedback' => 'I wanted someone to hear the tailoring work before talking about money. The form felt like a request, not a promise.'],
            ['name' => 'Meera Devi', 'photo' => 'images/clients/client-02.png', 'location' => 'Jaipur, Rajasthan', 'feedback' => 'They asked about the vegetable cart, not about a guaranteed amount. That honesty made it easier to write.'],
            ['name' => 'Lakshmi Reddy', 'photo' => 'images/clients/client-03.jpg', 'location' => 'Guntur, Andhra Pradesh', 'feedback' => 'I sent an enquiry first. Nobody told me I was already approved. The next call was just questions.'],
            ['name' => 'Farida Khan', 'photo' => 'images/clients/client-04.jpg', 'location' => 'Bhopal, Madhya Pradesh', 'feedback' => 'The story I needed to tell was about my stitching group. The website left space for that, without selling a rate.'],
            ['name' => 'Anita Kamble', 'photo' => 'images/clients/client-01.png', 'location' => 'Kolhapur, Maharashtra', 'feedback' => 'I used the application to describe dairy work. I still waited for a person to reply. That was the right order.'],
            ['name' => 'Pooja Sharma', 'photo' => 'images/clients/client-02.png', 'location' => 'Indore, Madhya Pradesh', 'feedback' => 'Sharing my experience here is not a promise that every woman will receive the same response.'],
        ];

        foreach ($stories as $index => $story) {
            ClientStory::query()->updateOrCreate(
                ['slug' => str($story['name'])->slug().'-story'],
                [...$story, 'is_published' => true, 'sort_order' => $index + 1]
            );
        }
    }

    private function seedGallery(): void
    {
        $images = [
            ['image' => 'images/carousel/01.jpg', 'label' => 'Field visit', 'alt_text' => 'Women gathered during a field visit'],
            ['image' => 'images/carousel/02.jpg', 'label' => 'Livelihood discussion', 'alt_text' => 'Discussion about livelihood work'],
            ['image' => 'images/carousel/03.jpg', 'label' => 'Community meeting', 'alt_text' => 'Community meeting in progress'],
            ['image' => 'images/carousel/04.jpg', 'label' => 'Workshop day', 'alt_text' => 'Workshop with women participants'],
            ['image' => 'images/carousel/05.jpg', 'label' => 'Local enterprise', 'alt_text' => 'A local enterprise workspace'],
            ['image' => 'images/clients/client-01.png', 'label' => 'Portrait one', 'alt_text' => 'Portrait of a community member'],
            ['image' => 'images/clients/client-02.png', 'label' => 'Portrait two', 'alt_text' => 'Portrait of a community member'],
            ['image' => 'images/clients/client-03.jpg', 'label' => 'Portrait three', 'alt_text' => 'Portrait of a community member'],
            ['image' => 'images/clients/client-04.jpg', 'label' => 'Leadership desk', 'alt_text' => 'Portrait used for leadership communication'],
            ['image' => 'images/carousel/02.jpg', 'label' => 'Follow-up visit', 'alt_text' => 'Follow-up conversation in the field'],
        ];

        foreach ($images as $index => $image) {
            GalleryImage::query()->updateOrCreate(
                ['label' => $image['label']],
                [...$image, 'is_active' => true, 'sort_order' => $index + 1]
            );
        }
    }

    private function seedFaqs(): void
    {
        $faqs = [
            ['question' => 'Does submitting the form approve my loan?', 'answer' => 'No. The form is a request for a conversation. This website does not approve or disburse loans.', 'category' => 'Application', 'is_featured' => true],
            ['question' => 'Will you tell me an interest rate here?', 'answer' => 'No. We do not publish or invent rates on this site. Any number you see elsewhere should not be treated as our offer.', 'category' => 'General', 'is_featured' => true],
            ['question' => 'Who can apply?', 'answer' => 'The offerings are designed with women livelihood applicants in mind. Eligibility is reviewed after we receive a form, not before.', 'category' => 'Application', 'is_featured' => true],
            ['question' => 'What happens after I apply?', 'answer' => 'Staff receive an email and an in-panel alert. Someone may contact you for more detail, or the request may be closed without a loan.', 'category' => 'Application', 'is_featured' => true],
            ['question' => 'Can I enquire without applying?', 'answer' => 'Yes. Use the contact page for questions that are not a full application.', 'category' => 'Support', 'is_featured' => true],
            ['question' => 'Are the stories typical results?', 'answer' => 'No. Stories are individual accounts. They are not a forecast of what you will receive.', 'category' => 'General', 'is_featured' => true],
            ['question' => 'Do I need every document on day one?', 'answer' => 'The product pages list items often requested. We will tell you if something else is needed after review.', 'category' => 'Application', 'is_featured' => false],
            ['question' => 'How do I reach the office?', 'answer' => 'Phone, email, address, and hours are listed on the contact page and come from the organisation settings.', 'category' => 'Support', 'is_featured' => false],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::query()->updateOrCreate(
                ['question' => $faq['question']],
                [...$faq, 'is_active' => true, 'sort_order' => $index + 1]
            );
        }
    }

    /**
     * @param  list<LoanProduct>  $products
     */
    private function seedApplications(array $products): void
    {
        if (LoanApplication::query()->exists()) {
            return;
        }

        LoanApplication::factory()->create([
            'loan_product_id' => $products[0]->id,
            'full_name' => 'Kavita Joshi',
            'status' => ApplicationStatus::New,
        ]);

        LoanApplication::factory()->create([
            'loan_product_id' => $products[1]->id,
            'full_name' => 'Rekha Nair',
            'status' => ApplicationStatus::UnderReview,
        ]);
    }

    private function seedInquiries(): void
    {
        if (Inquiry::query()->exists()) {
            return;
        }

        Inquiry::factory()->create([
            'name' => 'Sonal Gupta',
            'subject' => 'Question about livelihood starter',
            'status' => InquiryStatus::New,
        ]);

        Inquiry::factory()->create([
            'name' => 'Deepa Iyer',
            'subject' => 'Office hours',
            'status' => InquiryStatus::InProgress,
        ]);
    }
}
