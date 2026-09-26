<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
{
    public function run(): void
    {
        $niveaux = DB::table('niveaux')->pluck('id', 'code');
        $secteurs = DB::table('secteurs')->pluck('id', 'code');

        $filieres = [
            // ===== BAC TECHNO =====
            ['code' => 'TGI', 'libelle' => 'Technologie Génie Industriel', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TGC', 'libelle' => 'Technologie Génie Civil', 'niveau' => 'BAC', 'secteur' => 'GC'],
            ['code' => 'TTR', 'libelle' => 'Technologie Tertiaire', 'niveau' => 'BAC', 'secteur' => 'TER'],

            // ===== BAC PRO - INDUSTRIEL =====
            ['code' => 'TPFM', 'libelle' => 'Technicien productique en fabrication mécanique', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TMA',  'libelle' => 'Technicien maintenance automobile', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TMEL', 'libelle' => 'Technicien en électrotechnique', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'EN',   'libelle' => 'Electronicien', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TMF',  'libelle' => 'Technicien en métaux en feuilles', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TOM',  'libelle' => 'Technicien en ouvrages métalliques', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'MEMA', 'libelle' => 'Mécanicien d\'engins et matériels agricoles', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'MAE',  'libelle' => 'Mécanique auto et engin', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TFFI', 'libelle' => 'Technicien frigoriste froid industriel', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TAMB', 'libelle' => 'Technicien en art et métier bois', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TCNB', 'libelle' => 'Technicien en construction navale bois', 'niveau' => 'BAC', 'secteur' => 'IND'],

            // ===== BAC PRO - GENIE CIVIL =====
            ['code' => 'CCBTP', 'libelle' => 'Chef de chantier bâtiment et travaux publics', 'niveau' => 'BAC', 'secteur' => 'GC'],
            ['code' => 'PCBTP', 'libelle' => 'Chef calculateur bâtiment et travaux publics', 'niveau' => 'BAC', 'secteur' => 'GC'],

            // ===== BAC PRO - TERTIAIRE =====
            ['code' => 'CG',  'libelle' => 'Comptable gestion', 'niveau' => 'BAC', 'secteur' => 'TER'],
            ['code' => 'GF',  'libelle' => 'Gestion et finance', 'niveau' => 'BAC', 'secteur' => 'TER'],
            ['code' => 'SS',  'libelle' => 'Secrétaire secrétariat', 'niveau' => 'BAC', 'secteur' => 'TER'],
            ['code' => 'TAC', 'libelle' => 'Technique administrative et communication', 'niveau' => 'BAC', 'secteur' => 'TER'],
            ['code' => 'ACTC','libelle' => 'Agent commercial technique commerciale', 'niveau' => 'BAC', 'secteur' => 'TER'],

            // ===== BAC PRO - AGRICOLE =====
            ['code' => 'TAG', 'libelle' => 'Technicien d\'agriculture', 'niveau' => 'BAC', 'secteur' => 'AGR'],
            ['code' => 'TEV', 'libelle' => 'Technicien d\'élevage', 'niveau' => 'BAC', 'secteur' => 'AGR'],

            // ===== BAC PRO - TOURISME =====
            ['code' => 'CPA', 'libelle' => 'Cuisine pâtissier', 'niveau' => 'BAC', 'secteur' => 'THR'],
            ['code' => 'SEQ', 'libelle' => 'Serveur qualifié', 'niveau' => 'BAC', 'secteur' => 'THR'],

            // ===== BEP =====
            ['code' => 'BEP-AGR1', 'libelle' => 'Technicien d\'Agriculture', 'niveau' => 'BEP', 'secteur' => 'AGR'],
            ['code' => 'BEP-AGR2', 'libelle' => 'Technicien d\'Elevage', 'niveau' => 'BEP', 'secteur' => 'AGR'],
            ['code' => 'BEP-ART',  'libelle' => 'Céramiste', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-GC1',  'libelle' => 'Chef d\'Equipe de Chantier', 'niveau' => 'BEP', 'secteur' => 'GC'],
            ['code' => 'BEP-GC2',  'libelle' => 'Dessinateur Métreur', 'niveau' => 'BEP', 'secteur' => 'GC'],
            ['code' => 'BEP-HAB1', 'libelle' => 'Confection', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-HAB2', 'libelle' => 'Couturier', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-HAB3', 'libelle' => 'Tailleur', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND1', 'libelle' => 'Ameublement Bois', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND2', 'libelle' => 'Charpenterie Navale Bois/PRVT', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND3', 'libelle' => 'Construction Navale Bois', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND4', 'libelle' => 'Menuiserie Bois', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND5', 'libelle' => 'Technicien en Audio-Visuel', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND6', 'libelle' => 'Technicien en Télécommunication', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND7', 'libelle' => 'Electrotechnicien Industriel', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND8', 'libelle' => 'Fraiseur', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND9', 'libelle' => 'Tourneur', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND10','libelle' => 'Agent de Maintenance en Froid', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND11','libelle' => 'Imprimeur / Compositeur', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND12','libelle' => 'Installation Sanitaire et Thermique', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND13','libelle' => 'Maintenancier d\'Automobile', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND14','libelle' => 'Maintenancier d\'Engin et Mécanismes Agricoles', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND15','libelle' => 'Métaux en Feuilles', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND16','libelle' => 'Ouvrages Métalliques', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-TER1', 'libelle' => 'Secrétaire', 'niveau' => 'BEP', 'secteur' => 'TER'],
            ['code' => 'BEP-TER2', 'libelle' => 'Comptable', 'niveau' => 'BEP', 'secteur' => 'TER'],
            ['code' => 'BEP-TER3', 'libelle' => 'Agent Commercial', 'niveau' => 'BEP', 'secteur' => 'TER'],
            ['code' => 'BEP-TOU1', 'libelle' => 'Chef de Partie', 'niveau' => 'BEP', 'secteur' => 'THR'],
            ['code' => 'BEP-TOU2', 'libelle' => 'Cuisine/Pâtisserie', 'niveau' => 'BEP', 'secteur' => 'THR'],
            ['code' => 'BEP-TOU3', 'libelle' => 'Restaurant Bar', 'niveau' => 'BEP', 'secteur' => 'THR'],

            // ===== CAP =====
            ['code' => 'CAP-AGR1', 'libelle' => 'Agent d\'Agriculture', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-AGR2', 'libelle' => 'Agent d\'Elevage', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-AGR3', 'libelle' => 'Horticulture', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-AGR4', 'libelle' => 'Jardinier-Paysagiste', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-AGR5', 'libelle' => 'Pépiniériste', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-GC1',  'libelle' => 'Commis de Chantier', 'niveau' => 'CAP', 'secteur' => 'GC'],
            ['code' => 'CAP-GC2',  'libelle' => 'Commis Métreur', 'niveau' => 'CAP', 'secteur' => 'GC'],
            ['code' => 'CAP-HAB1', 'libelle' => 'Coupe-Couture-Broderie', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND1', 'libelle' => 'Ameublement Bois', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND2', 'libelle' => 'Construction Navale Bois', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND3', 'libelle' => 'Menuisier', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND4', 'libelle' => 'Electrotechnicien de Bâtiment', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND5', 'libelle' => 'Tôlier', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-TER1', 'libelle' => 'Employé de Bureau', 'niveau' => 'CAP', 'secteur' => 'TER'],
            ['code' => 'CAP-TOU1', 'libelle' => 'Restauration', 'niveau' => 'CAP', 'secteur' => 'THR'],

            // ===== CFA =====
            ['code' => 'CFA-MACON',   'libelle' => 'Maçon', 'niveau' => 'CFA', 'secteur' => 'GC'],
            ['code' => 'CFA-MONTBRO', 'libelle' => 'Montage Broderie', 'niveau' => 'CFA', 'secteur' => 'IND'],
            ['code' => 'CFA-MENU',    'libelle' => 'Menuisier «Atelier et Pose»', 'niveau' => 'CFA', 'secteur' => 'IND'],
            ['code' => 'CFA-FORG',    'libelle' => 'Forgeron', 'niveau' => 'CFA', 'secteur' => 'IND'],

            // ===== CAPS =====
            ['code' => 'CAPS-CAR',  'libelle' => 'Carreleur-Finisseur-Peintre et Plâtrier', 'niveau' => 'CAPS', 'secteur' => 'GC'],
            ['code' => 'CAPS-CHA',  'libelle' => 'Charpenterie Couvreur Bois', 'niveau' => 'CAPS', 'secteur' => 'GC'],
            ['code' => 'CAPS-MAC',  'libelle' => 'Maçon Gros Œuvre', 'niveau' => 'CAPS', 'secteur' => 'GC'],
            ['code' => 'CAPS-INS',  'libelle' => 'Installateur Sanitaire et Plomberie', 'niveau' => 'CAPS', 'secteur' => 'GC'],
            ['code' => 'CAPS-ELE',  'libelle' => 'Electricien de Bâtiment', 'niveau' => 'CAPS', 'secteur' => 'IND'],
            ['code' => 'CAPS-SOU',  'libelle' => 'Soudeur Métallier', 'niveau' => 'CAPS', 'secteur' => 'IND'],
        ];

        foreach ($filieres as $f) {
            DB::table('filieres')->insert([
                'code' => $f['code'],
                'libelle' => $f['libelle'],
                'niveau_id' => $niveaux[$f['niveau']],
                'secteur_id' => $secteurs[$f['secteur']],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ===== OPTIONS =====
        $options = [
            ['filiere_code' => 'TMEL',  'libelle' => 'énergie renouvelable'],
            ['filiere_code' => 'TOM',   'libelle' => 'menuiserie en aluminium'],
            ['filiere_code' => 'TFFI',  'libelle' => 'énergie renouvelable'],
            ['filiere_code' => 'TAMB',  'libelle' => 'valorisation et gestion des ressources naturelles'],
            ['filiere_code' => 'PCBTP', 'libelle' => 'Dessin assisté par ordinateur (DAO)'],
        ];

        foreach ($options as $o) {
            $filiere = DB::table('filieres')->where('code', $o['filiere_code'])->first();
            if ($filiere) {
                DB::table('filiere_options')->insert([
                    'filiere_id' => $filiere->id,
                    'libelle' => $o['libelle'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}