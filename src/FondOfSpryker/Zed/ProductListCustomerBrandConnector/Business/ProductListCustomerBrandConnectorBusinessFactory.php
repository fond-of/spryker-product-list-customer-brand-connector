<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business;

use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model\CustomerBrandRelationWriter;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model\CustomerBrandRelationWriterInterface;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\ProductListCustomerBrandConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ProductListCustomerBrandConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model\CustomerBrandRelationWriterInterface
     */
    public function createCustomerBrandRelationWriter(): CustomerBrandRelationWriterInterface
    {
        return new CustomerBrandRelationWriter(
            $this->getBrandCustomerFacade(),
            $this->getProductListFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
     */
    protected function getBrandCustomerFacade(): ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
    {
        return $this->getProvidedDependency(ProductListCustomerBrandConnectorDependencyProvider::FACADE_BRAND_CUSTOMER);
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface
     */
    protected function getProductListFacade(): ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface
    {
        return $this->getProvidedDependency(ProductListCustomerBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST);
    }
}
