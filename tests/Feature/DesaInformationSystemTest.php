<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\Official;
use App\Models\PageView;
use App\Models\User;
use App\Models\VillageProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DesaInformationSystemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_public_pages_can_be_accessed_without_login(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Desa Tautpah');

        $response = $this->get('/profil');
        $response->assertStatus(200);
        $response->assertSee('Visi & Misi');

        $response = $this->get('/pemerintahan');
        $response->assertStatus(200);
        $response->assertSee('Pemerintah Desa Tautpah');

        $response = $this->get('/berita');
        $response->assertStatus(200);

        $response = $this->get('/galeri');
        $response->assertStatus(200);

        $response = $this->get('/kontak');
        $response->assertStatus(200);
        $response->assertSee('Biboki Selatan');
    }

    public function test_article_detail_increments_views_and_displays_content(): void
    {
        $article = Article::published()->first();
        $initialViews = $article->views_count;

        $response = $this->get('/berita/' . $article->slug);
        $response->assertStatus(200);
        $response->assertSee($article->title);

        $this->assertEquals($initialViews + 1, $article->fresh()->views_count);
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $response = $this->post('/login', [
            'login' => 'admin',
            'password' => 'admin123',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticated();

        $dashboardResponse = $this->get('/admin/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Ringkasan Dashboard Admin');
    }

    public function test_kepala_desa_can_login_and_access_monitoring(): void
    {
        $response = $this->post('/login', [
            'login' => 'kades',
            'password' => 'kades123',
        ]);

        $response->assertRedirect('/kepala-desa/dashboard');
        $this->assertAuthenticated();

        $kadesResponse = $this->get('/kepala-desa/dashboard');
        $kadesResponse->assertStatus(200);
        $kadesResponse->assertSee('Panel Pemantauan (Read-Only)');
    }

    public function test_kepala_desa_is_restricted_from_admin_routes(): void
    {
        $kades = User::where('role', 'kepala_desa')->first();
        $response = $this->actingAs($kades)->get('/admin/dashboard');

        // Middleware redirects kades to kades dashboard
        $response->assertRedirect(route('kepaladesa.dashboard'));
    }

    public function test_admin_can_create_article_and_log_is_recorded(): void
    {
        $admin = User::where('role', 'admin')->first();
        $category = Category::first();

        $response = $this->actingAs($admin)->post('/admin/articles', [
            'title' => 'Uji Coba Berita Baru Admin',
            'type' => 'berita',
            'category_id' => $category->id,
            'summary' => 'Ringkasan singkat uji coba',
            'content' => 'Isi berita lengkap untuk pengujian sistem desa.',
            'status' => 'published',
        ]);

        $response->assertRedirect('/admin/articles');
        $this->assertDatabaseHas('articles', [
            'title' => 'Uji Coba Berita Baru Admin',
        ]);

        $this->assertDatabaseHas('activity_logs', [
            'action' => 'TAMBAH',
            'module' => 'Berita',
        ]);
    }
}
