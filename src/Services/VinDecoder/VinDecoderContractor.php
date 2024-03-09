<?php

namespace Services\VinDecoder;

interface VinDecoderContractor
{
    public function decoder(string $vin_code);
}
