<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Communication\ProductListCustomerExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\ProductListCustomerBrandConnectorFacade;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Communication\Plugin\ProductListCustomerExtension\CustomerBrandProductListCustomerPostSavePlugin;
use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class CustomerBrandProductListCustomerPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Communication\Plugin\ProductListCustomerExtension\CustomerBrandProductListCustomerPostSavePlugin
     */
    protected $customerBrandProductListCustomerPostSavePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\ProductListCustomerBrandConnectorFacade
     */
    protected $productListCustomerBrandConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCustomerRelationTransfer
     */
    protected $productListCustomerRelationTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListCustomerBrandConnectorFacadeMock = $this->getMockBuilder(ProductListCustomerBrandConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerRelationTransferMock = $this->getMockBuilder(ProductListCustomerRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerBrandProductListCustomerPostSavePlugin = new class (
            $this->productListCustomerBrandConnectorFacadeMock
        ) extends CustomerBrandProductListCustomerPostSavePlugin {
            /**
             * @var \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\ProductListCustomerBrandConnectorFacadeInterface
             */
            protected $productListCustomerBrandConnectorFacade;

            /**
             * @param \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\ProductListCustomerBrandConnectorFacade $productListCustomerBrandConnectorFacade
             */
            public function __construct(ProductListCustomerBrandConnectorFacade $productListCustomerBrandConnectorFacade)
            {
                $this->productListCustomerBrandConnectorFacade = $productListCustomerBrandConnectorFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            public function getFacade(): AbstractFacade
            {
                return $this->productListCustomerBrandConnectorFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->productListCustomerBrandConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('saveCustomerBrandRelationByIdProductListAndCustomerIds')
            ->with($this->productListCustomerRelationTransferMock)
            ->willReturn($this->productListCustomerRelationTransferMock);

        $this->assertInstanceOf(
            ProductListCustomerRelationTransfer::class,
            $this->customerBrandProductListCustomerPostSavePlugin->postSave(
                $this->productListCustomerRelationTransferMock
            )
        );
    }
}
