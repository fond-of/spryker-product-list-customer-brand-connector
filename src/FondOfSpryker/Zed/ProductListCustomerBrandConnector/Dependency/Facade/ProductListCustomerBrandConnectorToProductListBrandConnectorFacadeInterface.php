<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade;

use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function findProductListBrandRelationByIdProductList(
        ProductListTransfer $productListTransfer
    ): ProductListTransfer;
}
