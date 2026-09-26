# ==========================================
# EXPORT DE TOUTES LES VUES DANS UN FICHIER
# ==========================================

$outputFile = "TOUTES_LES_VUES.txt"
$viewsPath = "resources\views"

Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  EXPORT DE TOUTES LES VUES" -ForegroundColor Cyan
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""

# Vider le fichier de sortie
"" | Out-File -FilePath $outputFile -Encoding UTF8

# En-tête
@"
============================================================
  SGFORMATEURS — TOUTES LES VUES
  Généré le : $(Get-Date -Format 'dd/MM/yyyy HH:mm:ss')
  Dossier : $((Get-Location).Path)
============================================================

"@ | Out-File -FilePath $outputFile -Encoding UTF8 -Append

# Récupérer toutes les vues
$views = Get-ChildItem -Path $viewsPath -Recurse -Filter "*.blade.php" | Sort-Object FullName

Write-Host "  Nombre de vues trouvées : $($views.Count)" -ForegroundColor Green
Write-Host ""

$count = 0

foreach ($view in $views) {
    $count++
    
    # Chemin relatif
    $relativePath = $view.FullName.Replace((Get-Location).Path + "\", "")
    
    # En-tête du fichier
    $header = @"

============================================================
  FICHIER #$count : $relativePath
============================================================

"@
    
    $header | Out-File -FilePath $outputFile -Encoding UTF8 -Append
    
    # Contenu du fichier
    Get-Content $view.FullName -Encoding UTF8 | Out-File -FilePath $outputFile -Encoding UTF8 -Append
    
    # Séparateur
    "" | Out-File -FilePath $outputFile -Encoding UTF8 -Append
    
    Write-Host "  ✅ [$count/$($views.Count)] $relativePath" -ForegroundColor Green
}

Write-Host ""
Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  ✅ EXPORT TERMINÉ" -ForegroundColor Green
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "  Fichier créé : $outputFile" -ForegroundColor Yellow
Write-Host "  Nombre de vues : $($views.Count)" -ForegroundColor Yellow
Write-Host "  Taille : $([math]::Round((Get-Item $outputFile).Length / 1KB, 2)) KB" -ForegroundColor Yellow
Write-Host ""

# Ouvrir le fichier automatiquement
Start-Process $outputFile