<?php

namespace Tests\Feature;

use App\Filament\Resources\GalleryImages\GalleryImageResource;
use App\Filament\Resources\GalleryImages\Pages\CreateGalleryImage;
use App\Filament\Resources\GalleryImages\Pages\EditGalleryImage;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\GenerateSignedUploadUrl;
use Livewire\Livewire;
use Tests\TestCase;

class GalleryImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_livewire_temporary_upload_accepts_an_image(): void
    {
        Storage::fake('tmp-for-tests');

        $admin = $this->makeAdmin();
        $file = UploadedFile::fake()->image('community.jpg', 320, 240);
        $url = app(GenerateSignedUploadUrl::class)->forLocal();

        $this->actingAs($admin)
            ->post($url, ['files' => [$file]])
            ->assertOk()
            ->assertJsonStructure(['paths']);
    }

    public function test_super_admin_can_create_a_gallery_image_with_an_upload(): void
    {
        Storage::fake('public');

        $admin = $this->makeAdmin();
        $category = $this->makeCategory();
        $file = UploadedFile::fake()->image('community.jpg', 320, 240);

        Livewire::actingAs($admin)
            ->test(CreateGalleryImage::class)
            ->fillForm([
                'title' => 'Community meeting',
                'description' => 'Demo gallery image for review.',
                'gallery_category_id' => $category->id,
                'alt_text' => 'Community meeting photograph',
                'image_path' => [$file],
                'is_active' => true,
                'sort_order' => 1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $image = GalleryImage::query()->where('title', 'Community meeting')->first();

        $this->assertNotNull($image);
        $this->assertNotEmpty($image->image_path);
        Storage::disk('public')->assertExists($image->image_path);
    }

    public function test_editing_title_only_keeps_the_existing_image(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('gallery/keep.jpg', 'existing-image');

        $admin = $this->makeAdmin();
        $image = GalleryImage::query()->create([
            'gallery_category_id' => $this->makeCategory()->id,
            'title' => 'Original title',
            'image_path' => 'gallery/keep.jpg',
            'alt_text' => 'Existing photograph',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Livewire::actingAs($admin)
            ->test(EditGalleryImage::class, ['record' => $image->getKey()])
            ->fillForm([
                'title' => 'Updated title',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $image->refresh();

        $this->assertSame('Updated title', $image->title);
        $this->assertSame('gallery/keep.jpg', $image->image_path);
        Storage::disk('public')->assertExists('gallery/keep.jpg');
    }

    public function test_replacing_an_image_stores_the_new_file_and_removes_the_old_gallery_file(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('gallery/old.jpg', 'old-image');

        $admin = $this->makeAdmin();
        $image = GalleryImage::query()->create([
            'gallery_category_id' => $this->makeCategory()->id,
            'title' => 'Replace me',
            'image_path' => 'gallery/old.jpg',
            'alt_text' => 'Photograph to replace',
            'is_active' => true,
            'sort_order' => 1,
        ]);
        $file = UploadedFile::fake()->image('replacement.png', 320, 240);

        Livewire::actingAs($admin)
            ->test(EditGalleryImage::class, ['record' => $image->getKey()])
            ->fillForm([
                'image_path' => [$file],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $image->refresh();

        $this->assertNotSame('gallery/old.jpg', $image->image_path);
        Storage::disk('public')->assertMissing('gallery/old.jpg');
        Storage::disk('public')->assertExists($image->image_path);
    }

    public function test_deleting_a_gallery_image_removes_the_stored_file(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('gallery/remove.jpg', 'stored-image');

        $admin = $this->makeAdmin();
        $image = GalleryImage::query()->create([
            'gallery_category_id' => $this->makeCategory()->id,
            'title' => 'Delete me',
            'image_path' => 'gallery/remove.jpg',
            'alt_text' => 'Photograph to delete',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Livewire::actingAs($admin)
            ->test(EditGalleryImage::class, ['record' => $image->getKey()])
            ->callAction('delete');

        $this->assertNull(GalleryImage::query()->find($image->id));
        Storage::disk('public')->assertMissing('gallery/remove.jpg');
    }

    public function test_the_public_gallery_shows_active_images(): void
    {
        $this->seed(SiteSettingSeeder::class);

        GalleryImage::query()->create([
            'gallery_category_id' => $this->makeCategory()->id,
            'title' => 'Field visit',
            'description' => 'A published gallery photograph.',
            'image_path' => 'images/logo-square.png',
            'alt_text' => 'Field visit photograph',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->get(route('gallery'))
            ->assertOk()
            ->assertSee('Field visit')
            ->assertSee('Field visit photograph')
            ->assertSee('/storage/images/logo-square.png');
    }

    public function test_viewer_cannot_create_gallery_images(): void
    {
        $viewer = $this->makeAdmin('Viewer');

        $this->actingAs($viewer)
            ->get(GalleryImageResource::getUrl('create'))
            ->assertForbidden();
    }

    private function makeCategory(): GalleryCategory
    {
        return GalleryCategory::query()->create([
            'name' => 'Community',
            'slug' => 'community-'.uniqid(),
            'is_active' => true,
            'sort_order' => 1,
        ]);
    }
}
