<?php
/**
 *
 * @package Azguards_ProductType
 */
declare(strict_types=1);

namespace Azguards\ProductType\Plugin\Minicart;

use Magento\Checkout\CustomerData\AbstractItem;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Azguards\ProductType\Model\Product\Attribute\Source\ProductType;
use Psr\Log\LoggerInterface;

class AfterGetItemData
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * AfterGetImageUrl constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        LoggerInterface $logger
    ) {
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    /**
     * After Get ItemData
     *
     * @param AbstractItem $item
     * @param array $result
     * @return mixed
     */
    public function afterGetItemData(AbstractItem $item, $result)
    {
        try {
            if ($result['product_id'] > 0) {
                $product = $this->productRepository->getById($result['product_id']);
                $customAttribute = $product->getCustomAttribute('product_type');
                if ($customAttribute && $customAttribute->getValue() == ProductType::CUSTOM_TYPE) {
                    $image = "https://images.pexels.com/photos/270348/pexels-photo-270348.jpeg";
                    $result['product_image']['src'] = $image;
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('Exception occurred in AfterGetItemData plugin: ' . $e->getMessage());
        }
        return $result;
    }
}
