# ==========================================
# EXPORT COMPLET DU PROJET SGFORMATEURS
# ==========================================

$outputFile = "TOUT_LE_PROJET.txt"
$basePath = (Get-Location).Path

Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  EXPORT COMPLET DU PROJET SGFORMATEURS" -ForegroundColor Cyan
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""

# Vider le fichier de sortie
"" | Out-File -FilePath $outputFile -Encoding UTF8

# En-tête
@"
============================================================
  SGFORMATEURS — PROJET COMPLET
  Généré le : $(Get-Date -Format 'dd/MM/yyyy HH:mm:ss')
  Dossier : $basePath
============================================================

TABLE DES MATIÈRES
-------------------
1. Configuration (composer.json, .env, bootstrap, config)
2. Application (app/)
3. Base de données (database/)
4. Routes (routes/)
5. Vues (resources/views/)
6. Tests (tests/)
7. Fichiers racine (artisan, etc.)

"@ | Out-File -FilePath $outputFile -Encoding UTF8 -Append

# ==========================================
# DOSSIERS À EXPORTER
# ==========================================
$folders = @(
    "app",
    "bootstrap",
    "config",
    "database",
    "routes",
    "resources\views",
    "tests"
)

$totalFiles = 0
$totalSize = 0

foreach ($folder in $folders) {
    $folderPath = Join-Path $basePath $folder
    
    if (-not (Test-Path $folderPath)) {
        Write-Host "  ⚠️  Dossier non trouvé : $folder" -ForegroundColor Yellow
        continue
    }
    
    Write-Host ""
    Write-Host "📁 Export : $folder" -ForegroundColor Cyan
    
    # Section
    $sectionHeader = @"

================================================================
  📁 SECTION : $($folder.ToUpper())
================================================================

"@
    $sectionHeader | Out-File -FilePath $outputFile -Encoding UTF8 -Append
    
    # Récupérer tous les fichiers (php, blade, json, etc.)
    $files = Get-ChildItem -Path $folderPath -Recurse -File | 
             Where-Object { 
                 $_.Extension -in @('.php', '.blade.php', '.json', '.env', '.xml', '.yml', '.yaml') -or
                 $_.Name -in @('artisan', '.env', '.env.example')
             } |
             Sort-Object FullName
    
    $folderCount = 0
    
    foreach ($file in $files) {
        $folderCount++
        $totalFiles++
        $totalSize += $file.Length
        
        # Chemin relatif
        $relativePath = $file.FullName.Replace($basePath + "\", "")
        
        # En-tête du fichier
        $fileHeader = @"

----------------------------------------------------------------
  FICHIER #$totalFiles : $relativePath
  Taille : $([math]::Round($file.Length / 1KB, 2)) KB
----------------------------------------------------------------

"@
        $fileHeader | Out-File -FilePath $outputFile -Encoding UTF8 -Append
        
        # Contenu du fichier
        try {
            Get-Content $file.FullName -Encoding UTF8 -ErrorAction Stop | 
                Out-File -FilePath $outputFile -Encoding UTF8 -Append
        } catch {
            "⚠️ Impossible de lire le fichier : $($file.FullName)" | 
                Out-File -FilePath $outputFile -Encoding UTF8 -Append
        }
        
        # Séparateur
        "" | Out-File -FilePath $outputFile -Encoding UTF8 -Append
    }
    
    $folderSize = [math]::Round(($files | Measure-Object -Property Length -Sum).Sum / 1KB, 2)
    Write-Host "  ✅ $folderCount fichier(s) → $folderSize KB" -ForegroundColor Green
}

# ==========================================
# FICHIERS RACINE
# ==========================================
Write-Host ""
Write-Host "📄 Export : fichiers racine" -ForegroundColor Cyan

@"

================================================================
  📄 FICHIERS RACINE
================================================================

"@ | Out-File -FilePath $outputFile -Encoding UTF8 -Append

$rootFiles = @(
    "composer.json",
    "package.json",
    "phpunit.xml",
    "vite.config.js",
    "artisan",
    ".env",
    ".env.example",
    "README.md"
)

$rootCount = 0

foreach ($rootFile in $rootFiles) {
    $filePath = Join-Path $basePath $rootFile
    
    if (Test-Path $filePath) {
        $rootCount++
        $totalFiles++
        
        $fileHeader = @"

----------------------------------------------------------------
  FICHIER #$totalFiles : $rootFile
----------------------------------------------------------------

"@
        $fileHeader | Out-File -FilePath $outputFile -Encoding UTF8 -Append
        
        try {
            Get-Content $filePath -Encoding UTF8 -ErrorAction Stop | 
                Out-File -FilePath $outputFile -Encoding UTF8 -Append
        } catch {
            "⚠️ Impossible de lire : $rootFile" | 
                Out-File -FilePath $outputFile -Encoding UTF8 -Append
        }
        
        "" | Out-File -FilePath $outputFile -Encoding UTF8 -Append
    }
}

Write-Host "  ✅ $rootCount fichier(s) racine" -ForegroundColor Green

# ==========================================
# FIN
# ==========================================
$outputSize = [math]::Round((Get-Item $outputFile).Length / 1KB, 2)

Write-Host ""
Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  ✅ EXPORT TERMINÉ" -ForegroundColor Green
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "  Fichier créé : $outputFile" -ForegroundColor Yellow
Write-Host "  Nombre total de fichiers : $totalFiles" -ForegroundColor Yellow
Write-Host "  Taille du fichier : $outputSize KB" -ForegroundColor Yellow
Write-Host ""

# Ouvrir le fichier
Start-Process $outputFile