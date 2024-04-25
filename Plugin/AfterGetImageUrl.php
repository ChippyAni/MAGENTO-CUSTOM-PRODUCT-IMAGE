<?php
/**
 *
 * @package Azguards_ProductType
 */
declare(strict_types=1);

namespace Azguards\ProductType\Plugin;

use Magento\Catalog\Block\Product\Image;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Azguards\ProductType\Model\Product\Attribute\Source\ProductType;
use Psr\Log\LoggerInterface;

class AfterGetImageUrl
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
     * After call
     *
     * @param Image $image
     * @param array $result
     * @param array $method
     * @return array|null
     */
    public function after__call(Image $image, $result, $method)
    {
        try {
            $product = $this->productRepository->getById($image->getData('product_id'));
            $customAttribute = $product->getCustomAttribute('product_type');
            if ($customAttribute) {
                $value = $customAttribute->getValue();
                if ($method == 'getImageUrl' && $image->getProductId() > 0 && $value == ProductType::CUSTOM_TYPE) {
                    $result = "https://images.pexels.com/photos/270348/pexels-photo-270348.jpeg";
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('Exception occurred in AfterGetImageUrl plugin: ' . $e->getMessage());
        }
        return $result;
    }
}
