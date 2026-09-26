<?php

namespace Infrastructure\Services;

interface PdfExporterInterface
{
    /**
     * Génère un PDF (téléchargement)
     */
    public function generate(string $view, array $data, string $filename): \Symfony\Component\HttpFoundation\Response;

    /**
     * Génère un PDF (affichage navigateur)
     */
    public function stream(string $view, array $data, string $filename): \Symfony\Component\HttpFoundation\Response;
}