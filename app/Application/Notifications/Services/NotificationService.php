<?php

namespace Application\Notifications\Services;

use App\Models\Notification;

class NotificationService
{
    /**
     * Crée une notification pour les admins
     */
    public static function creer(
        string $titre,
        string $message,
        string $type = 'info',
        string $icone = 'notifications',
        ?string $lien = null,
        ?int $userId = null,
        ?array $data = null
    ): Notification {
        return Notification::create([
            'user_id' => $userId,
            'titre' => $titre,
            'message' => $message,
            'type' => $type,
            'icone' => $icone,
            'lu' => false,
            'lien' => $lien,
            'data' => $data,
        ]);
    }

    /**
     * Notifie la création d'un formateur
     */
    public static function formateurCree(string $nomComplet, string $matricule, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Nouveau formateur ajouté',
            message: "{$nomComplet} ({$matricule}) a été ajouté au système.",
            type: 'success',
            icone: 'person_add',
            lien: $lien,
        );
    }

    /**
     * Notifie la création d'un établissement
     */
    public static function etablissementCree(string $nom, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Nouvel établissement créé',
            message: "L'établissement « {$nom} » a été créé.",
            type: 'success',
            icone: 'apartment',
            lien: $lien,
        );
    }

    /**
     * Notifie une affectation
     */
    public static function affectationCreee(string $formateur, string $filiere, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Nouvelle affectation',
            message: "{$formateur} a été affecté à la filière « {$filiere} ».",
            type: 'info',
            icone: 'assignment_ind',
            lien: $lien,
        );
    }

    /**
     * Notifie une session créée
     */
    public static function sessionCreee(string $code, string $formateur, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Nouvelle session de formation',
            message: "Session {$code} créée pour {$formateur}.",
            type: 'info',
            icone: 'event',
            lien: $lien,
        );
    }

    /**
     * Notifie la modification d'une affectation
     */
    public static function affectationModifiee(string $formateur, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Affectation modifiée',
            message: "L'affectation de {$formateur} a été modifiée.",
            type: 'warning',
            icone: 'edit',
            lien: $lien,
        );
    }

    /**
     * Notifie une suppression
     */
    public static function suppression(string $entite, string $nom): Notification
    {
        return self::creer(
            titre: 'Suppression effectuée',
            message: "L'élément « {$nom} » ({$entite}) a été supprimé.",
            type: 'danger',
            icone: 'delete',
        );
    }
}