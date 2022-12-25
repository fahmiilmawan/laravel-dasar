<?php

namespace App\Service;

class HalloServiceIndonesia implements HalloService
{
    public function halo(string $name): string
    {
        return "halo $name";
    }
}
