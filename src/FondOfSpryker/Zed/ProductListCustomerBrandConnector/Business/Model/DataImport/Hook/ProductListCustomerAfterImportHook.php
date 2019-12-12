<?php

namespace FondOfSpryker\Zed\ProductListCustomerBrandConnector\Business\Model\DataImport\Hook;

use FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface;
use FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;
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

        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {
            if (count($productListTransfer->getBrandRelation()->getIdBrands()) > 0 &&
                count($productListTransfer->getProductListCustomerRelation()->getCustomerIds()) > 0
            ) {
                $this->saveCustomerBrandRelations(
                    $productListTransfer->getProductListCustomerRelation()->getCustomerIds(),
                    $productListTransfer->getBrandRelation()->getIdBrands()
                );
            }
        }
    }

    /**
     * @param array $customerIds
     * @param array $brandIds
     *
     * @return void
     */
    protected function saveCustomerBrandRelations(array $customerIds, array $brandIds): void
    {
        foreach ($customerIds as $idCustomer) {
            $this->brandCustomerFacade->saveCustomerBrandRelation(
                (new CustomerBrandRelationTransfer())->setIdCustomer($idCustomer)->setIdBrands($brandIds)
            );
        }
    }
}
