<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerBrandRelationTransfer;

interface ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerBrandRelationTransfer $customerBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBrandRelationTransfer
     */
    public function saveCustomerBrandRelation(
        CustomerBrandRelationTransfer $customerBrandRelationTransfer
    ): CustomerBrandRelationTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerBrandRelationTransfer $customerBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBrandRelationTransfer
     */
    public function findCustomerBrandRelationByIdCustomer(
        CustomerBrandRelationTransfer $customerBrandRelationTransfer
    ): CustomerBrandRelationTransfer;
}
