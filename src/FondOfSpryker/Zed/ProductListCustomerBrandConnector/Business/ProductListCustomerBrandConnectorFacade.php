<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business;

use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\ProductListCustomerBrandConnectorBusinessFactory getFactory()
 */
class ProductListCustomerBrandConnectorFacade extends AbstractFacade implements ProductListCustomerBrandConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListCustomerRelationTransfer $productListCustomerRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCustomerRelationTransfer
     */
    public function saveCustomerBrandRelationByIdProductListAndCustomerIds(
        ProductListCustomerRelationTransfer $productListCustomerRelationTransfer
    ): ProductListCustomerRelationTransfer {
        return $this->getFactory()
            ->createCustomerBrandRelationWriter()
            ->saveCustomerBrandRelationByIdProductListAndCustomerIds($productListCustomerRelationTransfer);
    }
}
