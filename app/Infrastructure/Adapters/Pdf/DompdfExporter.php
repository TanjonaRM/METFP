<?php

namespace Infrastructure\Adapters\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use Infrastructure\Services\PdfExporterInterface;

class DompdfExporter implements PdfExporterInterface
{
    public function generate(string $view, array $data, string $filename): \Symfony\Component\HttpFoundation\Response
    {
        $pdf = Pdf::loadView($view, $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        return $pdf->download($filename . '.pdf');
    }

    public function stream(string $view, array $data, string $filename): \Symfony\Component\HttpFoundation\Response
    {
        $pdf = Pdf::loadView($view, $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        return $pdf->stream($filename . '.pdf');
    }
}