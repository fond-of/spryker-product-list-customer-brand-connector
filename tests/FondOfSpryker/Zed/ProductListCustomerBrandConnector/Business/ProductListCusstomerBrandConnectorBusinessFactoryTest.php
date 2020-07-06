<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model\CustomerBrandRelationWriter;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\ProductListCustomerBrandConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductListCusstomerBrandConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\ProductListCustomerBrandConnectorBusinessFactory
     */
    protected $productListCustomerBrandConnectorBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
     */
    protected $productListBrandConnectorToBrandCustomerFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface
     */
    protected $productListBrandConnectorToProductListFacadeInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerBrandConnectorToBrandCustomerFacadeInterfaceMock = $this->getMockBuilder(ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerBrandConnectorToProductListBrandConnectorFacadeInterfaceMock = $this->getMockBuilder(ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerBrandConnectorBusinessFactory = new ProductListCustomerBrandConnectorBusinessFactory();
        $this->productListCustomerBrandConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerBrandRelationWriter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ProductListCustomerBrandConnectorDependencyProvider::FACADE_BRAND_CUSTOMER],
                [ProductListCustomerBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST]
            )->willReturnOnConsecutiveCalls(
                $this->productListCustomerBrandConnectorToBrandCustomerFacadeInterfaceMock,
                $this->productListCustomerBrandConnectorToProductListBrandConnectorFacadeInterfaceMock
            );

        $this->assertInstanceOf(
            CustomerBrandRelationWriter::class,
            $this->productListCustomerBrandConnectorBusinessFactory->createCustomerBrandRelationWriter()
        );
    }
}
