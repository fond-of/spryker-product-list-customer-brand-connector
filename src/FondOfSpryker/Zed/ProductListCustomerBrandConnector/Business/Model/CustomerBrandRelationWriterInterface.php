<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model;

use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;

interface CustomerBrandRelationWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCustomerRelationTransfer $productListCustomerRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCustomerRelationTransfer
     */
    public function saveCustomerBrandRelationByIdProductListAndCustomerIds(
        ProductListCustomerRelationTransfer $productListCustomerRelationTransfer
    ): ProductListCustomerRelationTransfer;
}
