<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Communication\Plugin\ProductListCustomerExtension;

use FondOfSpryker\Zed\ProductListCustomerExtension\Dependency\Plugin\ProductListCustomerPostSavePluginInterface;
use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\ProductListCustomerBrandConnectorFacadeInterface getFacade()
 */
class CustomerBrandProductListCustomerPostSavePlugin extends AbstractPlugin implements ProductListCustomerPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCustomerRelationTransfer $productListCustomerRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCustomerRelationTransfer
     */
    public function postSave(
        ProductListCustomerRelationTransfer $productListCustomerRelationTransfer
    ): ProductListCustomerRelationTransfer {

        return $this
            ->getFacade()
            ->saveCustomerBrandRelationByIdProductListAndCustomerIds($productListCustomerRelationTransfer);
    }
}
