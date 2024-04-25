<?php
/**
 *
 * @package Azguards_ProductType
 */
declare(strict_types=1);

namespace Azguards\ProductType\Model\Product\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class ProductType extends AbstractSource
{
    public const STANDARD_TYPE = 'Standard';
    public const CUSTOM_TYPE = 'Custom';

    /**
     * Get AllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        $options = [
            0 => [
                'label' => 'Standard',
                'value' => self::STANDARD_TYPE
            ],
            1 => [
                'label' => 'Custom',
                'value' => self::CUSTOM_TYPE
            ],
        ];
        return $options;
    }
}
