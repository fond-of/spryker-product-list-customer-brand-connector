<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model\DataImport\Hook;

use FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface;
use FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Orm\Zed\BrandCustomer\Persistence\FosBrandCustomerQuery;
use Spryker\Zed\DataImport\Business\Model\DataImporterAfterImportInterface;

class ProductListCustomerAfterImportHook implements DataImporterAfterImportInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface
     */
    protected $brandCustomerFacade;

    /**
     * @var \Spryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $productListFacade;


    public function __construct(
        BrandCustomerFacadeInterface $brandCustomerFacade,
        ProductListFacadeInterface $productListFacade
    ) {
        $this->brandCustomerFacade = $brandCustomerFacade;
        $this->productListFacade = $productListFacade;
    }

    /**
     * @return void
     */
    public function afterImport(): void
    {
        $this->rebuildRelations();
    }

    /**
     * @return void
     */
    protected function rebuildRelations(): void
    {
        $this->deleteCustomerBrandRelations();
        $this->createCustomerBrandRelations();
    }

    /**
     * @return int
     */
    protected function deleteCustomerBrandRelations(): int
    {
        return FosBrandCustomerQuery::create()->doDeleteAll();
    }

    /**
     *
     * @return void
     */
    protected function createCustomerBrandRelations()
    {
        $productListCollectionTransfer = $this->productListFacade->getAllProductLists();

        if ($productListCollectionTransfer === null) {
            return null;
        }
        $customerBrandRelations = [];
        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {

            if (count($productListTransfer->getBrandRelation()->getIdBrands()) > 0 &&
                count($productListTransfer->getProductListCustomerRelation()->getCustomerIds()) > 0
            ) {
                $customerBrandRelations = $this
                    ->buildCustomeBrandRelationsForProductListTransfer($productListTransfer, $customerBrandRelations);
            }
        }

        if (count($customerBrandRelations) === 0) {
            return null;
        }

        $this->saveCustomerBrandRelations($customerBrandRelations);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     * @param array $customerBrandRelations
     * 
     * @return array
     */
    protected function buildCustomeBrandRelationsForProductListTransfer(
        ProductListTransfer $productListTransfer,
        array $customerBrandRelations
    ): array {
        foreach ($productListTransfer->getProductListCustomerRelation()->getCustomerIds() as $customerId) {

            if (array_key_exists($customerId, $customerBrandRelations) === false) {
                $customerBrandRelations[$customerId] = $productListTransfer->getBrandRelation()->getIdBrands();
                continue;
            }

            $customerBrandRelations[$customerId] = array_unique(array_merge(
                $customerBrandRelations[$customerId],
                $productListTransfer->getBrandRelation()->getIdBrands()
            ));
        }

        return $customerBrandRelations;
    }

    /**
     * @param array $customerBrandRelations
     */
    protected function saveCustomerBrandRelations(array $customerBrandRelations): void
    {
        foreach ($customerBrandRelations as $idCustomer => $brandIds) {
            $this->brandCustomerFacade->saveCustomerBrandRelation(
                (new CustomerBrandRelationTransfer())->setIdCustomer($idCustomer)->setIdBrands($brandIds)
            );
        }
    }
}
