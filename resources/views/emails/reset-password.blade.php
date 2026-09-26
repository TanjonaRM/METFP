<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation de mot de passe</title>
</head>
<body style="font-family: 'Inter', Arial, sans-serif; background: #f8fafc; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 101, 44, 0.1);">
        <div style="background: linear-gradient(135deg, #059669, #047857); padding: 40px; text-align: center;">
            <h1 style="color: white; margin: 0; font-size: 28px;">SGFORMATEURS</h1>
            <p style="color: rgba(255,255,255,0.9); margin-top: 8px;">Réinitialisation de mot de passe</p>
        </div>
        <div style="padding: 40px;">
            <h2 style="color: #1e293b; margin-top: 0;">Bonjour,</h2>
            <p style="color: #64748b; line-height: 1.6;">Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.</p>
            <div style="text-align: center; margin: 32px 0;">
                <a href="{{ $url }}" style="display: inline-block; background: linear-gradient(135deg, #059669, #047857); color: white; padding: 14px 32px; border-radius: 12px; text-decoration: none; font-weight: 600;">
                    Réinitialiser mon mot de passe
                </a>
            </div>
            <p style="color: #64748b; line-height: 1.6; font-size: 14px;">Ce lien expirera dans 60 minutes.</p>
            <p style="color: #94a3b8; font-size: 12px; margin-top: 32px; padding-top: 24px; border-top: 1px solid #e2e8f0;">Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email.</p>
        </div>
        <div style="background: #f8fafc; padding: 20px; text-align: center;">
            <p style="color: #94a3b8; font-size: 12px; margin: 0;">© {{ date('Y') }} SGFORMATEURS - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>