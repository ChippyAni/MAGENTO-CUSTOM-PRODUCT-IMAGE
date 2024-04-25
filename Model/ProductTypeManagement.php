<?php
/**
 *
 * @package Azguards_ProductType
 */
declare(strict_types=1);

namespace Azguards\ProductType\Model;

use Azguards\ProductType\Api\ProductTypeManagementInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class ProductTypeManagement implements ProductTypeManagementInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * Constructor Parameters.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * Set Product Type
     *
     * @param String $sku
     * @param String $type
     * @return array|null
     */
    public function setProductType($sku, $type)
    {
        try {
            $product = $this->productRepository->get($sku);
            $product->setData('product_type', $type);
            $this->productRepository->save($product);
            return "Success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
