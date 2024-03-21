<?php

declare(strict_types=1);

namespace GymBeam\App\Api;

interface AttributeManagementInterface
{
    /**
     * @param int $productId
     * @param string $value
     *
     * @return bool
     */
    public function setGymBeamAttribute(int $productId, string $value): bool;
}
