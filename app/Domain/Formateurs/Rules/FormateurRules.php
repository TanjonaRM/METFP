<?php

namespace Domain\Formateurs\Rules;

class FormateurRules
{
    /**
     * Matricule : FORM-XXX (au moins 3 chiffres)
     */
    public static function validerMatricule(string $matricule): bool
    {
        return preg_match('/^FORM-\d{3,}$/', $matricule) === 1;
    }

    public static function validerEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validerStatut(string $statut): bool
    {
        return in_array($statut, ['actif', 'inactif', 'en_attente'], true);
    }

    public static function validerTelephone(?string $telephone): bool
    {
        if ($telephone === null || $telephone === '') {
            return true; // Optionnel
        }

        $cleaned = preg_replace('/[^0-9+]/', '', $telephone);

        return strlen($cleaned) >= 7 && strlen($cleaned) <= 20;
    }

    public static function validerNom(string $nom): bool
    {
        return !empty(trim($nom)) && strlen($nom) <= 100;
    }

    public static function validerPrenom(string $prenom): bool
    {
        return !empty(trim($prenom)) && strlen($prenom) <= 100;
    }

    public static function validerSexe(?string $sexe): bool
    {
        if ($sexe === null || $sexe === '') {
            return true;
        }

        return in_array($sexe, ['Masculin', 'Feminin'], true);
    }

    /**
     * Validation complète d'un tableau de données formateur
     *
     * @return array Tableau d'erreurs (vide si tout OK)
     */
    public static function valider(array $data): array
    {
        $erreurs = [];

        if (isset($data['matricule']) && !self::validerMatricule($data['matricule'])) {
            $erreurs['matricule'] = "Le matricule doit suivre le format FORM-XXX.";
        }

        if (isset($data['email']) && !self::validerEmail($data['email'])) {
            $erreurs['email'] = "L'email n'est pas valide.";
        }

        if (isset($data['nom']) && !self::validerNom($data['nom'])) {
            $erreurs['nom'] = "Le nom est obligatoire (max 100 caractères).";
        }

        if (isset($data['prenom']) && !self::validerPrenom($data['prenom'])) {
            $erreurs['prenom'] = "Le prénom est obligatoire (max 100 caractères).";
        }

        if (isset($data['telephone']) && !self::validerTelephone($data['telephone'])) {
            $erreurs['telephone'] = "Le téléphone n'est pas valide.";
        }

        if (isset($data['statut']) && !self::validerStatut($data['statut'])) {
            $erreurs['statut'] = "Le statut n'est pas valide.";
        }

        if (isset($data['sexe']) && !self::validerSexe($data['sexe'])) {
            $erreurs['sexe'] = "Le sexe n'est pas valide.";
        }

        return $erreurs;
    }
}