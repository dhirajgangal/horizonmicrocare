<?php

namespace App\View\Composers;

use App\Services\SiteSettings;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class PublicLayoutComposer
{
    public function __construct(private SiteSettings $settings) {}

    public function compose(View $view): void
    {
        $view->with([
            'site' => $this->settings,
            'primaryNavigation' => $this->primaryNavigation(),
            'footerColumns' => $this->footerColumns(),
        ]);
    }

    /**
     * @return Collection<int, array{label: string, route: string, children?: array<int, array{label: string, route: string}>}>
     */
    private function primaryNavigation(): Collection
    {
        return collect([
            ['label' => 'Home', 'route' => 'home'],
            ['label' => 'About Us', 'route' => 'about'],
            ['label' => 'Our Offerings', 'route' => 'loans.index'],
            ['label' => 'Our Mission', 'route' => 'mission'],
            ['label' => 'Client Stories', 'route' => 'stories.index'],
            ['label' => 'Gallery', 'route' => 'gallery'],
            ['label' => 'FAQs', 'route' => 'faqs'],
            ['label' => 'Contact Us', 'route' => 'contact'],
        ]);
    }

    /**
     * @return array<string, array{title: string, links: array<int, array{label: string, route: string}>}>
     */
    private function footerColumns(): array
    {
        return [
            'company' => [
                'title' => 'Company',
                'links' => [
                    ['label' => 'About Us', 'route' => 'about'],
                    ['label' => 'Our Mission', 'route' => 'mission'],
                    ['label' => 'Leadership', 'route' => 'about'],
                    ['label' => 'Client Stories', 'route' => 'stories.index'],
                ],
            ],
            'services' => [
                'title' => 'Services',
                'links' => [
                    ['label' => 'Loan Products', 'route' => 'loans.index'],
                    ['label' => 'How It Works', 'route' => 'how-it-works'],
                    ['label' => 'Eligibility', 'route' => 'eligibility'],
                    ['label' => 'FAQs', 'route' => 'faqs'],
                ],
            ],
            'support' => [
                'title' => 'Support',
                'links' => [
                    ['label' => 'Contact Us', 'route' => 'contact'],
                    ['label' => 'Customer Support', 'route' => 'grievance'],
                    ['label' => 'Grievance', 'route' => 'grievance'],
                    ['label' => 'Privacy Policy', 'route' => 'privacy'],
                ],
            ],
            'legal' => [
                'title' => 'Legal',
                'links' => [
                    ['label' => 'Terms & Conditions', 'route' => 'terms'],
                    ['label' => 'Privacy Policy', 'route' => 'privacy'],
                    ['label' => 'Disclaimer', 'route' => 'disclaimer'],
                    ['label' => 'Responsible Lending', 'route' => 'responsible-lending'],
                ],
            ],
        ];
    }
}
