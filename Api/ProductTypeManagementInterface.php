<?php
/**
 *
 * @package Azguards_ProductType
 */
declare(strict_types=1);

namespace Azguards\ProductType\Api;

interface ProductTypeManagementInterface
{
    /**
     * Set custom attribute value for product based on SKU
     *
     * @param string $sku
     * @param string $type
     * @return string
     */
    public function setProductType($sku, $type);
}
