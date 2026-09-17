<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function mission(): View
    {
        return view('pages.mission');
    }

    public function loans(): View
    {
        return $this->placeholder(
            title: 'Our Offerings',
            heading: 'Loan and livelihood offerings',
            summary: 'Product cards, amounts, tenure, and eligibility will appear here after they are configured in the Super Admin. Contact us for current details.',
            ctaLabel: 'Apply for a Loan',
            ctaRoute: 'apply',
        );
    }

    public function loan(string $slug): View
    {
        return $this->placeholder(
            title: 'Loan product',
            heading: 'Product details coming soon',
            summary: 'Each loan product will have its own page at this URL once offerings are published. The current path is reserved for “'.$slug.'”.',
            ctaLabel: 'View offerings',
            ctaRoute: 'loans.index',
        );
    }

    public function howItWorks(): View
    {
        return $this->placeholder(
            title: 'How It Works',
            heading: 'A clear, step-by-step process',
            summary: 'Application, review, verification, decision, and support steps will be listed here from the CMS. Approval is never guaranteed by visiting this page.',
        );
    }

    public function eligibility(): View
    {
        return $this->placeholder(
            title: 'Loan Eligibility',
            heading: 'Eligibility information',
            summary: 'Eligibility criteria will be published by the organization. Until then, please treat this page as a placeholder and contact the team for guidance.',
        );
    }

    public function responsibleLending(): View
    {
        return $this->placeholder(
            title: 'Responsible Lending',
            heading: 'Responsible and transparent lending',
            summary: 'Customer rights, repayment responsibilities, fees, and grievance information will be editable from the Super Admin.',
        );
    }

    public function stories(): View
    {
        return $this->placeholder(
            title: 'Client Stories',
            heading: 'Stories from the community',
            summary: 'Published stories will appear here only when the organization has consent and content. Demo testimonials will be clearly marked.',
        );
    }

    public function story(string $slug): View
    {
        return $this->placeholder(
            title: 'Client story',
            heading: 'Story details coming soon',
            summary: 'This reserved path (“'.$slug.'”) will display a consented client story after the CMS module is live.',
            ctaLabel: 'All stories',
            ctaRoute: 'stories.index',
        );
    }

    public function gallery(): View
    {
        $images = GalleryImage::query()
            ->with('category')
            ->where('is_active', true)
            ->whereHas('category', fn ($query) => $query->where('is_active', true))
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('pages.gallery', [
            'title' => 'Gallery',
            'images' => $images,
        ]);
    }

    public function faqs(): View
    {
        return $this->placeholder(
            title: 'FAQs',
            heading: 'Frequently asked questions',
            summary: 'Questions and answers will be grouped by category and maintained entirely from the Super Admin.',
        );
    }

    public function apply(): View
    {
        return $this->placeholder(
            title: 'Apply for a Loan',
            heading: 'Loan application',
            summary: 'A mobile-first application form will collect only the information the organization needs. Submission will never imply approval. The form ships in a later phase.',
            ctaLabel: 'Contact us',
            ctaRoute: 'contact',
        );
    }

    public function track(): View
    {
        return $this->placeholder(
            title: 'Track Application',
            heading: 'Track your application',
            summary: 'Applicants will be able to check status with a reference number and mobile number. Internal notes will never be shown publicly.',
        );
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function grievance(): View
    {
        return $this->placeholder(
            title: 'Grievance & Support',
            heading: 'Customer support and grievance',
            summary: 'Grievance officer details, channels, and response timelines will be configurable from the Super Admin.',
            ctaLabel: 'Contact us',
            ctaRoute: 'contact',
        );
    }

    public function careers(): View
    {
        return $this->placeholder(
            title: 'Careers',
            heading: 'Work with us',
            summary: 'Open roles will be published when the organization is ready to recruit.',
        );
    }

    public function news(): View
    {
        return $this->placeholder(
            title: 'News & Updates',
            heading: 'News and updates',
            summary: 'Official updates will appear here after the news module is enabled.',
        );
    }

    public function resources(): View
    {
        return $this->placeholder(
            title: 'Resources',
            heading: 'Financial literacy resources',
            summary: 'Educational articles and guides will be managed from the CMS. This is not financial advice.',
        );
    }

    public function privacy(): View
    {
        return $this->placeholder(
            title: 'Privacy Policy',
            heading: 'Privacy Policy',
            summary: 'The privacy policy will be maintained from the Super Admin. Until published, personal information should not be submitted beyond a general enquiry.',
        );
    }

    public function terms(): View
    {
        return $this->placeholder(
            title: 'Terms & Conditions',
            heading: 'Terms & Conditions',
            summary: 'Website terms will be published from the legal pages module.',
        );
    }

    public function disclaimer(): View
    {
        return $this->placeholder(
            title: 'Disclaimer',
            heading: 'Disclaimer',
            summary: 'Legal and financial disclaimers will be configurable. This website does not guarantee loans, rates, or regulatory status.',
        );
    }

    /**
     * @param  array<string, string>  $breadcrumbs
     */
    private function placeholder(
        string $title,
        string $heading,
        string $summary,
        string $ctaLabel = 'Apply for a Loan',
        string $ctaRoute = 'apply',
    ): View {
        return view('pages.placeholder', [
            'title' => $title,
            'heading' => $heading,
            'summary' => $summary,
            'ctaLabel' => $ctaLabel,
            'ctaRoute' => $ctaRoute,
        ]);
    }
}
