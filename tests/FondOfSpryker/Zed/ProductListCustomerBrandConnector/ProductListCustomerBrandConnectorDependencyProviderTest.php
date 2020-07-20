<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeBridge;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ProductListCustomerBrandConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCustomerBrandConnector\ProductListCustomerBrandConnectorDependencyProvider
     */
    protected $productListCustomerBrandConnectorDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface
     */
    protected $brandCustomerFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'offsetSet', 'offsetGet', 'set', 'get'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCustomerFacadeMock = $this->getMockBuilder(BrandCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorFacadeMock = $this->getMockBuilder(ProductListBrandConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerBrandConnectorDependencyProvider = new ProductListCustomerBrandConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->withConsecutive(['brandCustomer'], ['productListBrandConnector'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->brandCustomerFacadeMock,
                $this->productListBrandConnectorFacadeMock
            );

        $this->assertEquals(
            $this->containerMock,
            $this->productListCustomerBrandConnectorDependencyProvider->provideBusinessLayerDependencies($this->containerMock)
        );

        $this->assertInstanceOf(
            ProductListCustomerBrandConnectorToBrandCustomerFacadeBridge::class,
            $this->containerMock[ProductListCustomerBrandConnectorDependencyProvider::FACADE_BRAND_CUSTOMER]
        );

        $this->assertInstanceOf(
            ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeBridge::class,
            $this->containerMock[ProductListCustomerBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST]
        );
    }
}
