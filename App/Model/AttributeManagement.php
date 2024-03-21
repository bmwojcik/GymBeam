<?php

declare(strict_types=1);

namespace GymBeam\App\Model;

use GymBeam\App\Api\AttributeManagementInterface;
use GymBeam\App\Setup\Patch\Data\InstallGymBeamAttribute;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Monolog\Logger;

class AttributeManagement implements AttributeManagementInterface
{
    private ProductRepositoryInterface $productRepository;

    private Config $config;

    private Logger $logger;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param Config $config
     * @param Logger $logger
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        Config $config,
        Logger $logger
    ) {
        $this->productRepository = $productRepository;
        $this->logger = $logger;
        $this->config = $config;
    }

    /** @inheritdoc */
    public function setGymBeamAttribute(int $productId, string $value): bool
    {
        if (!$this->config->isGymBeamApiEnabled()) {

            return false;
        }

        try {
            $product = $this->productRepository->getById($productId);
            $product->setCustomAttribute(InstallGymBeamAttribute::ATTRIBUTE_CODE, $value);
            $this->productRepository->save($product);

            if ($this->config->isLoggingEnabled()) {
                $this->logger->info("Attribute updated for product ID {$productId} with value {$value}");
            }

            return true;
        } catch (\Exception $e) {
            $this->logger->error("Error updating attribute: " . $e->getMessage());

            return false;
        }
    }
}
