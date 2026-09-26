<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SGFORMATEURS')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <style>
        * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;
            box-sizing: border-box; margin: 0; padding: 0; }
        html, body { width: 100%; min-height: 100vh; }
        body {
            background: #fafafa;
            color: #18181b;
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }
        .font-display { font-family: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif; }

        .material-symbols-rounded {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            line-height: 1;
            vertical-align: middle;
        }
        ::selection { background: #10b981; color: #ffffff; }

        .rule-emerald { width: 48px; height: 2px; background: #059669; border-radius: 2px; }
        .rule-emerald-light { width: 48px; height: 2px; background: #6ee7b7; border-radius: 2px; }

        .label-caps {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #71717a;
        }
        .label-caps-light {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #a7f3d0;
        }

        .input-editorial {
            width: 100%;
            padding: 14px 16px;
            font-size: 14px;
            color: #18181b;
            background: #ffffff;
            border: 1.5px solid #e4e4e7;
            border-radius: 10px;
            outline: none;
            transition: all 0.15s ease;
            font-family: inherit;
        }
        .input-editorial::placeholder { color: #a1a1aa; }
        .input-editorial:hover { border-color: #d4d4d8; }
        .input-editorial:focus {
            border-color: #059669;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.10);
        }

        /* Bouton vert émeraude (par défaut) */
        .btn-emerald {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            border-radius: 12px;
            background: #059669;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-emerald:hover {
            background: #047857;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -6px rgba(5, 150, 105, 0.4);
        }

        /* Bouton vert émeraude outline */
        .btn-emerald-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            border-radius: 12px;
            background: #ffffff;
            color: #059669;
            font-size: 14px;
            font-weight: 600;
            border: 2px solid #059669;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-emerald-outline:hover {
            background: #ecfdf5;
            transform: translateY(-1px);
        }

        a { text-decoration: none; color: inherit; transition: color 0.15s ease; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>