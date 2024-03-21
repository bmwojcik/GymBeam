<?php

declare(strict_types=1);

namespace GymBeam\App\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    public const GYMBEAM_API_ENABLED_XML_PATH = 'gymbeam_modules/general/api_enable';

    public const GYMBEAM_LOGGING_ENABLED_XML_PATH = 'gymbeam_modules/general/log_enable';
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isGymBeamApiEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::GYMBEAM_API_ENABLED_XML_PATH,);
    }

    /**
     * @return bool
     */
    public function isLoggingEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::GYMBEAM_LOGGING_ENABLED_XML_PATH,);
    }
}
