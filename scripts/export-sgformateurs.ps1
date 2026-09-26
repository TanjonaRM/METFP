# ============================================================
# Script : Exporter tout le code du projet Laravel dans un .txt
# Projet : SGFormateurs
# Auteur : Export Laravel
# ============================================================


# ============================================================
# 1. CONFIGURATION
# ============================================================

# Chemin racine du projet Laravel
$root = "C:\xam\htdocs\SGFormateurs"

# Chemin du fichier TXT de sortie
$output = "C:\xam\htdocs\TOUT_LE_CODE_SGF.txt"


# ============================================================
# 2. EXTENSIONS DES FICHIERS À INCLURE
# ============================================================

$extensions = @(
    ".php",
    ".blade.php",
    ".js",
    ".css",
    ".sql",
    ".json",
    ".md",
    ".env",
    ".env.example",
    ".xml",
    ".yml",
    ".yaml",
    ".txt"
)


# ============================================================
# 3. DOSSIERS À EXCLURE
# ============================================================

$excludeDirs = @(
    "node_modules",
    "vendor",
    ".git",
    "storage\framework",
    "storage\logs",
    "public\build",
    "bootstrap\cache"
)


# ============================================================
# 4. VÉRIFICATION DU DOSSIER DU PROJET
# ============================================================

if (-not (Test-Path -LiteralPath $root -PathType Container)) {

    Write-Host ""
    Write-Host "ERREUR : Le dossier du projet n'existe pas :" -ForegroundColor Red
    Write-Host $root -ForegroundColor Yellow
    Write-Host ""

    exit
}


# ============================================================
# 5. SUPPRESSION DE L'ANCIEN FICHIER TXT
# ============================================================

if (Test-Path -LiteralPath $output) {

    Remove-Item `
        -LiteralPath $output `
        -Force `
        -ErrorAction SilentlyContinue
}


# ============================================================
# 6. CRÉATION DE L'EN-TÊTE DU FICHIER
# ============================================================

$header = @"
================================================================
              EXPORT COMPLET DU PROJET LARAVEL
================================================================

Projet       : SGFormateurs
Chemin       : $root
Date         : $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
Fichier      : $output

Extensions incluses :
- .php
- .blade.php
- .js
- .css
- .sql
- .json
- .md
- .env
- .env.example
- .xml
- .yml
- .yaml
- .txt

Dossiers exclus :
- node_modules
- vendor
- .git
- storage\framework
- storage\logs
- public\build
- bootstrap\cache

================================================================

"@

Set-Content `
    -LiteralPath $output `
    -Value $header `
    -Encoding UTF8


# ============================================================
# 7. INITIALISATION DES COMPTEURS
# ============================================================

$totalFiles = 0
$totalErrors = 0


# ============================================================
# 8. RÉCUPÉRATION DE TOUS LES FICHIERS
# ============================================================

$allFiles = Get-ChildItem `
    -LiteralPath $root `
    -Recurse `
    -File `
    -Force `
    -ErrorAction SilentlyContinue


# ============================================================
# 9. FILTRAGE DES FICHIERS
# ============================================================

$filesToExport = $allFiles | Where-Object {

    $file = $_
    $fullPath = $file.FullName

    # Vérifier si le fichier est dans un dossier exclu
    $isExcluded = $false

    foreach ($excludeDir in $excludeDirs) {

        $excludedPath = Join-Path $root $excludeDir

        # Ajouter le séparateur final pour éviter les faux résultats
        $excludedPathWithSeparator = $excludedPath.TrimEnd("\") + "\"

        if (
            $fullPath.StartsWith(
                $excludedPathWithSeparator,
                [System.StringComparison]::OrdinalIgnoreCase
            )
        ) {
            $isExcluded = $true
            break
        }
    }


    # Vérifier si l'extension du fichier est autorisée
    $hasAllowedExtension = $false

    foreach ($extension in $extensions) {

        if ($file.Name.EndsWith(
            $extension,
            [System.StringComparison]::OrdinalIgnoreCase
        )) {
            $hasAllowedExtension = $true
            break
        }
    }


    # Garder uniquement les fichiers autorisés
    (-not $isExcluded) -and $hasAllowedExtension
}


# ============================================================
# 10. TRI DES FICHIERS
# ============================================================

$filesToExport = $filesToExport | Sort-Object FullName


# ============================================================
# 11. EXPORT DE CHAQUE FICHIER
# ============================================================

foreach ($file in $filesToExport) {

    $totalFiles++

    # Chemin complet du fichier
    $fullPath = $file.FullName

    # Chemin relatif par rapport au projet
    $relativePath = $fullPath.Substring($root.Length).TrimStart("\")


    # ========================================================
    # 12. AFFICHER LA PROGRESSION
    # ========================================================

    Write-Host `
        ("[{0}] Export : {1}" -f $totalFiles, $relativePath) `
        -ForegroundColor Green


    # ========================================================
    # 13. EN-TÊTE DU FICHIER EXPORTÉ
    # ========================================================

    $fileHeader = @"

================================================================
FICHIER : $relativePath
CHEMIN  : $fullPath
TAILLE  : $($file.Length) octets
MODIFIÉ : $($file.LastWriteTime.ToString("yyyy-MM-dd HH:mm:ss"))
================================================================

"@

    Add-Content `
        -LiteralPath $output `
        -Value $fileHeader `
        -Encoding UTF8


    # ========================================================
    # 14. LECTURE DU CONTENU DU FICHIER
    # ========================================================

    try {

        $content = Get-Content `
            -LiteralPath $fullPath `
            -Raw `
            -Encoding UTF8 `
            -ErrorAction Stop


        Add-Content `
            -LiteralPath $output `
            -Value $content `
            -Encoding UTF8
    }

    catch {

        $totalErrors++

        $errorMessage = @"

[ERREUR DE LECTURE]

Fichier :
$fullPath

Message :
$($_.Exception.Message)

"@

        Add-Content `
            -LiteralPath $output `
            -Value $errorMessage `
            -Encoding UTF8
    }


    # ========================================================
    # 15. SÉPARATION ENTRE LES FICHIERS
    # ========================================================

    Add-Content `
        -LiteralPath $output `
        -Value "`r`n" `
        -Encoding UTF8
}


# ============================================================
# 16. AJOUT DU RÉSUMÉ FINAL DANS LE FICHIER TXT
# ============================================================

$footer = @"

================================================================
                     FIN DE L'EXPORT
================================================================

Projet          : SGFormateurs
Chemin projet   : $root
Nombre fichiers : $totalFiles
Nombre erreurs  : $totalErrors
Fichier généré  : $output
Date de fin     : $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")

================================================================
"@

Add-Content `
    -LiteralPath $output `
    -Value $footer `
    -Encoding UTF8


# ============================================================
# 17. MESSAGE FINAL DANS LE TERMINAL
# ============================================================

Write-Host ""
Write-Host "============================================================" -ForegroundColor Cyan
Write-Host "              EXPORT TERMINÉ AVEC SUCCÈS" -ForegroundColor Green
Write-Host "============================================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "Projet       : SGFormateurs" -ForegroundColor Yellow
Write-Host "Fichiers     : $totalFiles" -ForegroundColor Yellow
Write-Host "Erreurs      : $totalErrors" -ForegroundColor Yellow
Write-Host "Fichier TXT  : $output" -ForegroundColor Yellow

Write-Host ""
Write-Host "Le code du projet a été exporté dans le fichier TXT." -ForegroundColor Green
Write-Host "============================================================" -ForegroundColor Cyan