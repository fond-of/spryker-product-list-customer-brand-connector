<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade;

use FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacade;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;

class ProductListCustomerBrandConnectorToBrandCustomerFacadeBridge implements ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacade
     */
    protected $brandCustomerFacade;

    /**
     * @param \FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacade $brandCustomerFacade
     */
    public function __construct(BrandCustomerFacade $brandCustomerFacade)
    {
        $this->brandCustomerFacade = $brandCustomerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBrandRelationTransfer $customerBrandRelationTransfer
     *
     * @return void
     */
    public function saveCustomerBrandRelation(
        CustomerBrandRelationTransfer $customerBrandRelationTransfer
    ): void {
        $this->brandCustomerFacade->saveCustomerBrandRelation($customerBrandRelationTransfer);
    }
}
