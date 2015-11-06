<?php

namespace Vin\PlatformBundle\Antispam;

class VinAntispam
{

    public function isSpam($text)
    {
        return strlen($text) < 50;
    }

}