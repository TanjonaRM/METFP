<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Document') - SGFormateurs</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; padding: 20px 25px; line-height: 1.4; }

        .header { border-bottom: 3px solid #047857; padding-bottom: 12px; margin-bottom: 18px; }
        .header table { width: 100%; border: none; }
        .header table td { border: none; padding: 0; vertical-align: top; }
        .header h1 { color: #047857; font-size: 22px; font-weight: bold; margin-bottom: 4px; letter-spacing: 0.5px; }
        .header h2 { color: #555; font-size: 11px; font-weight: normal; line-height: 1.4; }
        .header .logo { text-align: right; font-size: 9px; color: #666; line-height: 1.5; }
        .header .logo strong { color: #047857; font-size: 11px; display: block; margin-bottom: 2px; }

        .doc-title { text-align: center; margin: 20px 0; padding: 12px; background: #f3f4f6; border-left: 4px solid #047857; border-radius: 3px; }
        .doc-title h3 { color: #047857; font-size: 16px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: bold; }
        .doc-title p { color: #666; font-size: 10px; margin-top: 5px; font-style: italic; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; }
        table thead { background: #047857; color: white; }
        table thead th { padding: 8px 6px; text-align: left; font-size: 9.5px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold; border: 1px solid #047857; }
        table tbody td { padding: 6px; border: 1px solid #ddd; font-size: 10px; vertical-align: top; }
        table tbody tr:nth-child(even) { background: #f9fafb; }

        .badge { display: inline-block; padding: 2px 7px; border-radius: 3px; font-size: 9px; font-weight: bold; text-transform: uppercase; }
        .badge-actif { background: #d1fae5; color: #065f46; }
        .badge-inactif { background: #e5e7eb; color: #374151; }
        .badge-en_attente { background: #fef3c7; color: #92400e; }
        .badge-present { background: #d1fae5; color: #065f46; }
        .badge-absent { background: #fee2e2; color: #991b1b; }
        .badge-retard { background: #fef3c7; color: #92400e; }
        .badge-excuse { background: #e5e7eb; color: #374151; }
        .badge-termine { background: #e5e7eb; color: #374151; }
        .badge-suspendu { background: #fee2e2; color: #991b1b; }

        .info-box { background: #f3f4f6; padding: 12px 15px; border-radius: 5px; border-left: 4px solid #047857; margin-bottom: 15px; }
        .info-box h3 { color: #047857; font-size: 13px; margin-bottom: 8px; font-weight: bold; }
        .info-box p { margin-bottom: 4px; font-size: 10.5px; line-height: 1.5; }
        .info-box strong { color: #047857; }
        .info-box table { margin: 0; }
        .info-box table td { border: none; padding: 3px 0; background: transparent !important; font-size: 10.5px; }

        .stats { width: 100%; margin-bottom: 18px; }
        .stats table { width: 100%; border: none; margin: 0; }
        .stats table td { border: none; padding: 0 5px; background: transparent !important; }
        .stat-card { background: #f3f4f6; padding: 12px 8px; border-radius: 5px; text-align: center; border-left: 3px solid #047857; }
        .stat-card .value { font-size: 20px; font-weight: bold; color: #047857; display: block; line-height: 1.2; }
        .stat-card .label { font-size: 9px; color: #666; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-top: 4px; }

        .footer { position: fixed; bottom: -10px; left: 0; right: 0; border-top: 1px solid #ddd; padding: 8px 25px; font-size: 9px; color: #666; }
        .footer table { width: 100%; border: none; margin: 0; }
        .footer table td { border: none; padding: 0; background: transparent !important; font-size: 9px; color: #666; }

        .signatures { margin-top: 50px; width: 100%; }
        .signatures table { width: 100%; border: none; margin: 0; }
        .signatures table td { border: none; padding: 0 20px; background: transparent !important; vertical-align: top; width: 50%; }
        .signature-block { text-align: center; }
        .signature-block .title { font-size: 11px; font-weight: bold; margin-bottom: 50px; }
        .signature-block .line { border-top: 1px solid #333; padding-top: 5px; font-size: 9px; color: #666; font-style: italic; }

        .no-data { text-align: center; padding: 25px; color: #999; font-style: italic; background: #f9fafb; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td style="width: 70%;">
                    <h1>SGFormateurs</h1>
                    <h2>Ministère de l'Enseignement Technique<br>et de la Formation Professionnelle</h2>
                </td>
                <td style="width: 30%;" class="logo">
                    <strong>METFP Madagascar</strong>
                    Généré le {{ now()->format('d/m/Y') }}<br>à {{ now()->format('H:i') }}
                </td>
            </tr>
        </table>
    </div>

    @hasSection('doc-title')
        <div class="doc-title">
            <h3>@yield('doc-title')</h3>
            @hasSection('doc-subtitle')<p>@yield('doc-subtitle')</p>@endif
        </div>
    @endif

    @yield('content')

    <div class="footer">
        <table>
            <tr>
                <td style="width: 70%;">SGFormateurs - Système de Gestion des Formateurs</td>
                <td style="width: 30%; text-align: right;">Document généré automatiquement</td>
            </tr>
        </table>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
            $font = $fontMetrics->getFont("DejaVu Sans", "normal");
            $width = $fontMetrics->get_text_width($text, $font, 9);
            $pdf->page_text(($pdf->get_width() - $width) / 2, $pdf->get_height() - 30, $text, $font, 9, [0.4, 0.4, 0.4]);
        }
    </script>
</body>
</html>