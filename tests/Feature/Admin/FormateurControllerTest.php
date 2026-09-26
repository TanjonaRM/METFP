<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Tests\TestCase;

class FormateurControllerTest extends TestCase
{
    use RefreshDatabase;

    private AdminModel $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = AdminModel::factory()->create();
    }

    public function test_index_affiche_liste(): void
    {
        FormateurModel::factory()->count(3)->create();

        $response = $this->actingAs($this->admin, 'admin')
            ->get('/admin/formateurs');

        $response->assertStatus(200);
        $response->assertViewHas('formateurs');
    }

    public function test_admin_peut_creer_formateur(): void
    {
        $response = $this->actingAs($this->admin, 'admin')
            ->post('/admin/formateurs', [
                'matricule' => 'FORM-100',
                'nom' => 'Test',
                'prenom' => 'Jean',
                'email' => 'test@metfp.mg',
                'telephone' => '0341234567',
            ]);

        $response->assertRedirect('/admin/formateurs');
        $this->assertDatabaseHas('formateurs', ['matricule' => 'FORM-100']);
    }

    public function test_admin_peut_modifier_formateur(): void
    {
        $formateur = FormateurModel::factory()->create();

        $response = $this->actingAs($this->admin, 'admin')
            ->put("/admin/formateurs/{$formateur->id}", [
                'nom' => 'Modifié',
                'prenom' => 'Test',
                'email' => $formateur->email,
                'telephone' => '0341234567',   // ⭐ AJOUT
                'statut' => 'actif',
            ]);

        $response->assertRedirect('/admin/formateurs');
        $this->assertDatabaseHas('formateurs', [
            'id' => $formateur->id,
            'nom' => 'Modifié',
        ]);
    }

    public function test_admin_peut_supprimer_formateur(): void
    {
        $formateur = FormateurModel::factory()->create();

        $response = $this->actingAs($this->admin, 'admin')
            ->delete("/admin/formateurs/{$formateur->id}");

        $response->assertRedirect('/admin/formateurs');
        $this->assertSoftDeleted('formateurs', ['id' => $formateur->id]);
    }

    public function test_non_admin_ne_peut_pas_acceder(): void
    {
        $response = $this->get('/admin/formateurs');
        $response->assertRedirect('/admin/login');
    }
}