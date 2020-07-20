<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;
use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class CustomerBrandRelationWriterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface
     */
    protected $productListBrandConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
     */
    protected $brandCustomerFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListCompanyRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListBrandCustomerFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListCustomerRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListCustomerRelationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\BrandRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandRelationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerBrandRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerBrandRelationTransferMock;

    /**
     * @var int
     */
    protected $idProductList;

    /**
     * @var int[]
     */
    protected $customerIds;

    /**
     * @var int[]
     */
    protected $brandIds;

    /**
     * @var \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model\CustomerBrandRelationWriter
     */
    protected $customerBrandRelationWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListBrandConnectorFacadeMock = $this->getMockBuilder(ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCustomerFacadeMock = $this->getMockBuilder(ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerRelationTransferMock = $this->getMockBuilder(ProductListCustomerRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCustomerRelationTransferMock = $this->getMockBuilder(ProductListCustomerRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandRelationTransferMock = $this->getMockBuilder(BrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerBrandRelationTransferMock = $this->getMockBuilder(CustomerBrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idProductList = 1;
        $this->customerIds = [1, 2];
        $this->brandIds = [1];

        $this->customerBrandRelationWriter = new CustomerBrandRelationWriter(
            $this->brandCustomerFacadeMock,
            $this->productListBrandConnectorFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testSaveCustomerBrandRelationByIdProductListAndCustomerIds(): void
    {
        $this->productListCustomerRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerIds')
            ->willReturn($this->customerIds);

        $this->productListCustomerRelationTransferMock->expects($this->atLeastOnce())
            ->method('getIdProductList')
            ->willReturn($this->idProductList);

        $this->productListBrandConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('findProductListBrandRelationByIdProductList')
            ->willReturn($this->brandRelationTransferMock);

        $this->brandRelationTransferMock->expects($this->atLeastOnce())
            ->method('getIdBrands')
            ->willReturn($this->brandIds);

        $this->customerBrandRelationTransferMock->expects($this->atLeastOnce())
            ->method('getIdBrands')
            ->willReturn($this->brandIds);

        $this->brandCustomerFacadeMock->expects($this->atLeastOnce())
            ->method('saveCustomerBrandRelation')
            ->willReturn($this->customerBrandRelationTransferMock);

        $this->brandCustomerFacadeMock->expects($this->atLeastOnce())
            ->method('findCustomerBrandRelationByIdCustomer')
            ->willReturn($this->customerBrandRelationTransferMock);

        $productListCustomerRelationTransfer = $this->customerBrandRelationWriter
            ->saveCustomerBrandRelationByIdProductListAndCustomerIds($this->productListCustomerRelationTransferMock);

        $this->assertEquals($this->productListCustomerRelationTransferMock, $productListCustomerRelationTransfer);
    }
}
