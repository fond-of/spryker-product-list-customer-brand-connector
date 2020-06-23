<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerBrandRelationTransfer;

interface ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerBrandRelationTransfer $customerBrandRelationTransfer
     */
    public function saveCustomerBrandRelation(
        CustomerBrandRelationTransfer $customerBrandRelationTransfer
    ): void;
}
