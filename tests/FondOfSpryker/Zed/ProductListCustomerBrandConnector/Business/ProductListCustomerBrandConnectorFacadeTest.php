<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model\CustomerBrandRelationWriterInterface;
use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;

class ProductListCustomerBrandConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\ProductListCustomerBrandConnectorFacade
     */
    protected $productListCustomerBrandConnectorFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\ProductListCustomerBrandConnectorBusinessFactory
     */
    protected $productListCustomerBrandConnectorBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCustomerRelationTransfer
     */
    protected $productListCustomerRelationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model\CustomerBrandRelationWriterInterface
     */
    protected $customerBrandRelationWriterMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListCustomerBrandConnectorBusinessFactoryMock = $this->getMockBuilder(ProductListCustomerBrandConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerRelationTransferMock = $this->getMockBuilder(ProductListCustomerRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerBrandRelationWriterMock = $this->getMockBuilder(CustomerBrandRelationWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerBrandConnectorFacade = new ProductListCustomerBrandConnectorFacade();
        $this->productListCustomerBrandConnectorFacade->setFactory($this->productListCustomerBrandConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testSaveCustomerBrandRelationByIdProductListAndCustomerIds(): void
    {
        $this->productListCustomerBrandConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCustomerBrandRelationWriter')
            ->willReturn($this->customerBrandRelationWriterMock);

        $this->customerBrandRelationWriterMock->expects($this->atLeastOnce())
            ->method('saveCustomerBrandRelationByIdProductListAndCustomerIds')
            ->with($this->productListCustomerRelationTransferMock)
            ->willReturn($this->productListCustomerRelationTransferMock);

        $this->assertEquals(
            $this->productListCustomerRelationTransferMock,
            $this->productListCustomerBrandConnectorFacade->saveCustomerBrandRelationByIdProductListAndCustomerIds(
                $this->productListCustomerRelationTransferMock
            )
        );
    }
}
