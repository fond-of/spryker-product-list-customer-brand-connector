<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business;

use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;

interface ProductListCustomerBrandConnectorFacadeInterface
{
    /**
     * Specification:
     *  - Save customer relations for the given Product List and Customer Ids
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListCustomerRelationTransfer $productListCustomerRelationTransferer
     *
     * @return \Generated\Shared\Transfer\ProductListCustomerRelationTransfer
     */
    public function saveCustomerBrandRelationByIdProductListAndCustomerIds(
        ProductListCustomerRelationTransfer $productListCustomerRelationTransferer
    ): ProductListCustomerRelationTransfer;
}
