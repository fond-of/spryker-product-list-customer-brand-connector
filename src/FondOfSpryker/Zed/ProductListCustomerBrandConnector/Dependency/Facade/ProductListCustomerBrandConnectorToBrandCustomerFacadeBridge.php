<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade;

use FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;

class ProductListCustomerBrandConnectorToBrandCustomerFacadeBridge implements ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacade
     */
    protected $brandCustomerFacade;

    /**
     * @param \FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface $brandCustomerFacade
     */
    public function __construct(BrandCustomerFacadeInterface $brandCustomerFacade)
    {
        $this->brandCustomerFacade = $brandCustomerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBrandRelationTransfer $customerBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBrandRelationTransfer
     */
    public function saveCustomerBrandRelation(
        CustomerBrandRelationTransfer $customerBrandRelationTransfer
    ): CustomerBrandRelationTransfer {
        return $this->brandCustomerFacade->saveCustomerBrandRelation($customerBrandRelationTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBrandRelationTransfer $customerBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBrandRelationTransfer
     */
    public function findCustomerBrandRelationByIdCustomer(
        CustomerBrandRelationTransfer $customerBrandRelationTransfer
    ): CustomerBrandRelationTransfer {
        return $this->brandCustomerFacade->findCustomerBrandRelationByIdCustomer($customerBrandRelationTransfer);
    }
}
