<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;
use Tests\TestCase;

class AllPagesTest extends TestCase
{
    use RefreshDatabase;

    private AdminModel $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = AdminModel::factory()->create();
    }

    private function checkPage(string $url): void
    {
        $response = $this->actingAs($this->admin, 'admin')->get($url);
        $response->assertStatus(200);
    }

    public function test_dashboard(): void { $this->checkPage('/admin/dashboard'); }
    public function test_formateurs_index(): void { $this->checkPage('/admin/formateurs'); }
    public function test_formateurs_create(): void { $this->checkPage('/admin/formateurs/create'); }
    public function test_etablissements_index(): void { $this->checkPage('/admin/etablissements'); }
    public function test_etablissements_create(): void { $this->checkPage('/admin/etablissements/create'); }
    public function test_filieres_index(): void { $this->checkPage('/admin/filieres'); }
    public function test_filieres_create(): void { $this->checkPage('/admin/filieres/create'); }
    public function test_niveaux_index(): void { $this->checkPage('/admin/niveaux'); }
    public function test_niveaux_create(): void { $this->checkPage('/admin/niveaux/create'); }
    public function test_secteurs_index(): void { $this->checkPage('/admin/secteurs'); }
    public function test_secteurs_create(): void { $this->checkPage('/admin/secteurs/create'); }
    public function test_sessions_index(): void { $this->checkPage('/admin/sessions'); }
    public function test_sessions_create(): void { $this->checkPage('/admin/sessions/create'); }
    public function test_affectations_index(): void { $this->checkPage('/admin/affectations'); }
    public function test_affectations_create(): void { $this->checkPage('/admin/affectations/create'); }
    public function test_presences_index(): void { $this->checkPage('/admin/presences'); }
    public function test_presences_create(): void { $this->checkPage('/admin/presences/create'); }
    public function test_users_index(): void { $this->checkPage('/admin/users'); }
    public function test_users_create(): void { $this->checkPage('/admin/users/create'); }
}