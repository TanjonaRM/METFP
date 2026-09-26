# ==========================================
# EXPORT DE TOUS LES CODES DES VUES
# ==========================================

$outputFile = "TOUS_LES_CODES_VUES.txt"
$basePath = (Get-Location).Path

Write-Host "Export en cours..." -ForegroundColor Cyan

# Vider le fichier
"" | Out-File -FilePath $outputFile -Encoding UTF8

# En-tête
@"
============================================================
  SGFORMATEURS - TOUS LES CODES DES VUES
  Genere le : $(Get-Date -Format 'dd/MM/yyyy HH:mm:ss')
============================================================

Ce fichier contient TOUS les codes sources des vues Blade.
Copiez-collez chaque bloc dans le fichier correspondant.

"@ | Out-File -FilePath $outputFile -Encoding UTF8 -Append

# Recuperer toutes les vues
$views = Get-ChildItem -Path "resources\views" -Recurse -Filter "*.blade.php" | Sort-Object FullName

$count = 0

foreach ($view in $views) {
    $count++
    $relativePath = $view.FullName.Replace($basePath + "\", "")
    
    # En-tete du fichier
    @"

================================================================
  FICHIER #$count : $relativePath
================================================================

"@ | Out-File -FilePath $outputFile -Encoding UTF8 -Append
    
    # Contenu du fichier
    Get-Content $view.FullName -Encoding UTF8 | Out-File -FilePath $outputFile -Encoding UTF8 -Append
    
    # Separateur
    "" | Out-File -FilePath $outputFile -Encoding UTF8 -Append
    "" | Out-File -FilePath $outputFile -Encoding UTF8 -Append
}

$size = [math]::Round((Get-Item $outputFile).Length / 1KB, 2)

Write-Host ""
Write-Host "=============================================" -ForegroundColor Green
Write-Host "  EXPORT TERMINE" -ForegroundColor Green
Write-Host "=============================================" -ForegroundColor Green
Write-Host ""
Write-Host "  Fichier : $outputFile" -ForegroundColor Yellow
Write-Host "  Nombre de vues : $count" -ForegroundColor Yellow
Write-Host "  Taille : $size KB" -ForegroundColor Yellow
Write-Host ""

# Ouvrir le fichier
Start-Process $outputFile