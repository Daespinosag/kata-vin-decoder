<?php

namespace Domains\Vin;

use Services\VinDecoder\VinDecoderService;

final readonly class VinValidateAction
{
    public function __construct(
        protected VinDecoderService $vinDecoderService
    ) {
    }

    public function run(string $vinCode): array
    {
        return $this->vinDecoderService->decoder($vinCode);
    }
}
