<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Builder\BuilderInterface;

class QrCodeGenerator
{
    private $builder;
    private $parameterBag;

    public function __construct(BuilderInterface $customQrCodeBuilder, ParameterBagInterface $parameterBag)
    {
        $this->builder = $customQrCodeBuilder;
        $this->parameterBag = $parameterBag;
    }

    public function generateQrCode($data, $path)
    {
       /* // Check if the logo image file exists
        $logoPath = $this->parameterBag->get('kernel.project_dir') . '/public/images/symfony.png';

        if (!file_exists($logoPath)) {
            // Handle the case where the logo file does not exist
            throw new \RuntimeException('Logo image not found.');
        }

        // Set the logo in the builder configuration
        $this->builder->logo($logoPath);

        // Build the QR code
        $result = $this->builder
            ->data($data)
            ->build();

        // Save the QR code to the specified path
        file_put_contents($path, $result->getString());

        return $path; // Optionally, you can return the path or any other data*/
    }
}
