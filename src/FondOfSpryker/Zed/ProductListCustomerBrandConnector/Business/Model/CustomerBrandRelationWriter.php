<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model;

use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface;
use FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;
use Generated\Shared\Transfer\ProductListCustomerRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class CustomerBrandRelationWriter implements CustomerBrandRelationWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface
     */
    protected $brandCustomerFacade;

    /**
     * @var \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface
     */
    protected $productListBrandConnectorFacade;

    /**
     * @param \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface $brandCustomerFacade
     * @param \FondOfSpryker\Zed\ProductListCustomerBrandConnector\Dependency\Facade\ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade
     */
    public function __construct(
        ProductListCustomerBrandConnectorToBrandCustomerFacadeInterface $brandCustomerFacade,
        ProductListCustomerBrandConnectorToProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade
    ) {
        $this->brandCustomerFacade = $brandCustomerFacade;
        $this->productListBrandConnectorFacade = $productListBrandConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCustomerRelationTransfer $productListCustomerRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCustomerRelationTransfer
     */
    public function saveCustomerBrandRelationByIdProductListAndCustomerIds(
        ProductListCustomerRelationTransfer $productListCustomerRelationTransfer
    ): ProductListCustomerRelationTransfer {
        if (
            count($productListCustomerRelationTransfer->getCustomerIds()) === 0
            || $productListCustomerRelationTransfer->getIdProductList() === null
        ) {
            return $productListCustomerRelationTransfer;
        }

        $productListTransfer = (new ProductListTransfer())
            ->setIdProductList($productListCustomerRelationTransfer->getIdProductList());
        $brandRelationTransfer = $this->productListBrandConnectorFacade
            ->findProductListBrandRelationByIdProductList($productListTransfer);

        if (count($brandRelationTransfer->getIdBrands()) === 0) {
            return $productListCustomerRelationTransfer;
        }

        $this->saveCustomerBrandRelations(
            $productListCustomerRelationTransfer->getCustomerIds(),
            $brandRelationTransfer->getIdBrands()
        );

        return $productListCustomerRelationTransfer;
    }

    /**
     * @param int[] $customerIds
     * @param int[] $brandIds
     *
     * @return void
     */
    protected function saveCustomerBrandRelations(
        array $customerIds,
        array $brandIds
    ): void {
        foreach ($customerIds as $idCustomer) {
            $saveBrandIds = array_unique(array_merge($brandIds, $this->findCurrentCustomerBrandIds($idCustomer)));
            $this->brandCustomerFacade->saveCustomerBrandRelation(
                (new CustomerBrandRelationTransfer())
                    ->setIdCustomer($idCustomer)
                    ->setIdBrands($saveBrandIds)
            );
        }
    }

    /**
     * @param int $idCustomer
     *
     * @return int[]
     */
    protected function findCurrentCustomerBrandIds(int $idCustomer): array
    {
        $customerBrandRelationTransfer = (new CustomerBrandRelationTransfer())->setIdCustomer($idCustomer);
        $currentCustomerBrandRelationTransfer =
            $this->brandCustomerFacade->findCustomerBrandRelationByIdCustomer($customerBrandRelationTransfer);

        if (count($currentCustomerBrandRelationTransfer->getIdBrands()) === 0) {
            return [];
        }

        return $currentCustomerBrandRelationTransfer->getIdBrands();
    }
}
