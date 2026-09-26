<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_login_admin_accessible(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    public function test_admin_peut_se_connecter(): void
    {
        $admin = AdminModel::factory()->create([
            'email' => 'admin@test.mg',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@test.mg',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_mauvais_mot_de_passe_rejete(): void
    {
        AdminModel::factory()->create([
            'email' => 'admin@test.mg',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@test.mg',
            'password' => 'mauvais',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest('admin');
    }

    public function test_admin_peut_se_deconnecter(): void
    {
        $admin = AdminModel::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->post('/admin/logout');
        $response->assertRedirect('/admin/login');
        $this->assertGuest('admin');
    }
}