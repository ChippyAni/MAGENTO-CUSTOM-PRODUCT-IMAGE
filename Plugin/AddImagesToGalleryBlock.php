<?php
/**
 *
 * @package Azguards_ProductType
 */
declare(strict_types=1);

namespace Azguards\ProductType\Plugin;

use Magento\Catalog\Block\Product\View\Gallery;
use Magento\Framework\Data\Collection;
use Magento\Framework\Data\CollectionFactory;
use Magento\Framework\DataObject;
use Azguards\ProductType\Model\Product\Attribute\Source\ProductType;

class AddImagesToGalleryBlock
{
    /**
     * @var CollectionFactory
     */
    private $dataCollectionFactory;

    /**
     * AddImagesToGalleryBlock constructor.
     *
     * @param CollectionFactory $dataCollectionFactory
     */
    public function __construct(
        CollectionFactory $dataCollectionFactory
    ) {
        $this->dataCollectionFactory = $dataCollectionFactory;
    }

    /**
     * AfterGalleryImages Plugin to change images and use external images stored in custom attribute
     *
     * @param Gallery $subject
     * @param Collection|null $images
     * @return Collection|null
     */
    public function afterGetGalleryImages(Gallery $subject, $images)
    {
        try {
            $product = $subject->getProduct();
            $productType = $product->getProductType();
            if ($productType != ProductType::CUSTOM_TYPE) {
                return $images;
            }
            $images = $this->dataCollectionFactory->create();
            $productName = $product->getName();
            $externalImages = ["https://images.pexels.com/photos/270348/pexels-photo-270348.jpeg"];
            foreach ($externalImages as $item) {
                $imageId    = uniqid();
                $small      = $item;
                $medium     = $item;
                $large      = $item;
                $image = [
                    'file' => $large,
                    'media_type' => 'image',
                    'value_id' => $imageId,
                    'row_id' => $imageId,
                    'label' => $productName,
                    'label_default' => $productName,
                    'position' => 100,
                    'position_default' => 100,
                    'disabled' => 0,
                    'url'  => $large,
                    'path' => '',
                    'small_image_url' => $small,
                    'medium_image_url' => $medium,
                    'large_image_url' => $large
                ];
                $images->addItem(new DataObject($image));
            }
            return $images;
        } catch (\Exception $e) {
            return $images;
        }
    }
}
