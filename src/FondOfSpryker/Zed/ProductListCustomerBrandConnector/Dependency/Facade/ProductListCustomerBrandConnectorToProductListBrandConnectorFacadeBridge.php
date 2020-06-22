<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade;

use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeBridge implements ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface
     */
    protected $productListBrandConnectorFacade;

    /**
     * @param \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade
     */
    public function __construct(ProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade)
    {
        $this->productListBrandConnectorFacade = $productListBrandConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function findProductListBrandRelationByIdProductList(
        ProductListTransfer $productListTransfer
    ): ProductListTransfer {
        return $this->productListBrandConnectorFacade->findProductListBrandRelationByIdProductList($productListTransfer);
    }
}
