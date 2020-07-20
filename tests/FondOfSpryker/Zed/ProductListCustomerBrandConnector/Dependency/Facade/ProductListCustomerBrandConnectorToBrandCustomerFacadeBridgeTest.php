<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;

class ProductListCustomerBrandConnectorToBrandCustomerFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface
     */
    protected $brandCustomerFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerBrandRelationTransfer
     */
    protected $customerBrandRelationTransferMock;

    /**
     * @var \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
     */
    protected $productListCustomerBrandConnectorToBrandCustomerFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandCustomerFacadeMock = $this->getMockBuilder(BrandCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerBrandRelationTransferMock = $this->getMockBuilder(CustomerBrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerBrandConnectorToBrandCustomerFacadeBridge = new ProductListCustomerBrandConnectorToBrandCustomerFacadeBridge(
            $this->brandCustomerFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testSaveCustomerBrandRelation(): void
    {
        $this->assertInstanceOf(
            CustomerBrandRelationTransfer::class,
            $this->productListCustomerBrandConnectorToBrandCustomerFacadeBridge->saveCustomerBrandRelation(
                $this->customerBrandRelationTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindCustomerBrandRelationByIdCustomer(): void
    {
        $this->assertInstanceOf(
            CustomerBrandRelationTransfer::class,
            $this->productListCustomerBrandConnectorToBrandCustomerFacadeBridge->findCustomerBrandRelationByIdCustomer(
                $this->customerBrandRelationTransferMock
            )
        );
    }
}
