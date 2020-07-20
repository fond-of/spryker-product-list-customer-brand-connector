<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector;

use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeBridge;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductListCustomerBrandConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_BRAND_CUSTOMER = 'FACADE_BRAND_CUSTOMER';
    public const FACADE_PRODUCT_LIST = 'FACADE_PRODUCT_LIST';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addBrandCustomerFacade($container);
        $container = $this->addProductListFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandCustomerFacade(Container $container): Container
    {
        $container[static::FACADE_BRAND_CUSTOMER] = static function (Container $container) {
            return new ProductListCustomerBrandConnectorToBrandCustomerFacadeBridge(
                $container->getLocator()->brandCustomer()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_LIST] = static function (Container $container) {
            return new ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeBridge(
                $container->getLocator()->productListBrandConnector()->facade()
            );
        };

        return $container;
    }
}
