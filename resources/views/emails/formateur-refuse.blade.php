<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription refusée</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9fafb; padding: 40px 20px; margin: 0;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden;">
        <div style="background: linear-gradient(135deg, #ef4444, #b91c1c); padding: 32px; text-align: center;">
            <h1 style="color: white; margin: 0; font-size: 22px;">[X] Inscription refusée</h1>
        </div>
        <div style="padding: 32px;">
            <p style="font-size: 15px; color: #0f172a;">Bonjour <strong>{{ $formateur->prenom }} {{ $formateur->nom }}</strong>,</p>
            <p style="font-size: 14px; color: #475569; line-height: 1.6;">
                Votre inscription sur <strong>SG Formateurs</strong> a été refusée.
            </p>
            @if($motif)
                <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; margin: 20px 0;">
                    <p style="margin: 0; font-size: 13px; color: #b91c1c;">
                        <strong>Motif :</strong><br>{{ $motif }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>