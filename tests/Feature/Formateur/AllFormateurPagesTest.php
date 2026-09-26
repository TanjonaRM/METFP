<?php

namespace Tests\Feature\Formateur;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurUserModel;
use Tests\TestCase;

class AllFormateurPagesTest extends TestCase
{
    use RefreshDatabase;

    private FormateurUserModel $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = FormateurUserModel::factory()->create([
            'matricule' => 'FORM-TEST',
            'email' => 'test@formateur.mg',
            'statut' => 'actif',
        ]);

        FormateurModel::factory()->create([
            'matricule' => $this->user->matricule,
            'email' => $this->user->email,
        ]);
    }

    private function checkPage(string $url): void
    {
        $response = $this->actingAs($this->user, 'formateur')->get($url);
        $response->assertStatus(200);
    }

    public function test_dashboard(): void { $this->checkPage('/formateur/dashboard'); }
    public function test_profile(): void { $this->checkPage('/formateur/profile'); }
    public function test_affectations(): void { $this->checkPage('/formateur/affectations'); }
    public function test_sessions(): void { $this->checkPage('/formateur/sessions'); }
    public function test_presences(): void { $this->checkPage('/formateur/presences'); }
    public function test_presences_create(): void { $this->checkPage('/formateur/presences/create'); }
}