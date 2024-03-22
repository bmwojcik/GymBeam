<?php

declare(strict_types=1);

namespace GymBeam\App\Test\Unit\Model;

use GymBeam\App\Model\AttributeManagement;
use GymBeam\App\Model\Config;
use GymBeam\App\Setup\Patch\Data\InstallGymBeamAttribute;
use PHPUnit\Framework\TestCase;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class AttributeManagementTest extends TestCase
{
    private $attributeManagement;
    private $productRepositoryMock;
    private $productMock;

    protected function setUp(): void
    {
        $objectManager = new ObjectManager($this);

        $this->productRepositoryMock = $this->getMockBuilder(ProductRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productMock = $this->getMockBuilder(Product::class)
            ->disableOriginalConstructor()
            ->getMock();

        $configMock = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        $configMock->method('isGymBeamApiEnabled')->willReturn(true);

        $this->attributeManagement = $objectManager->getObject(AttributeManagement::class, [
            'productRepository' => $this->productRepositoryMock,
            'config' => $configMock,
        ]);
    }

    public function testSetGymBeamAttribute()
    {
        $productId = 12;
        $attributeValue = 'ddd';

        $this->productRepositoryMock->expects($this->once())
            ->method('getById')
            ->with($productId)
            ->willReturn($this->productMock);

        $this->productMock->expects($this->once())
            ->method('setCustomAttribute')
            ->with(InstallGymBeamAttribute::ATTRIBUTE_CODE, $attributeValue)
            ->willReturnSelf();

        $this->productRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->productMock)
            ->willReturnSelf();

        $result = $this->attributeManagement->setGymBeamAttribute($productId, $attributeValue);
        $this->assertTrue($result);
    }
}
