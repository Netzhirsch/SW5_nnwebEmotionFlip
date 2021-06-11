<?php

namespace nnwebEmotionFlip\ComponentHandler;

use Shopware\Bundle\EmotionBundle\ComponentHandler\ComponentHandlerInterface;
use Shopware\Bundle\EmotionBundle\Struct\Collection\PrepareDataCollection;
use Shopware\Bundle\EmotionBundle\Struct\Collection\ResolvedDataCollection;
use Shopware\Bundle\EmotionBundle\Struct\Element;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

class nnwebEmotionFlipComponentHandler implements ComponentHandlerInterface {

	public function supports(Element $element) {
		return $element->getComponent()->getTemplate() === 'component_nnweb_emotion_flip';
	}

	public function prepare(PrepareDataCollection $collection, Element $element, ShopContextInterface $context) {
		$productNumber = $element->getConfig()->get('nnwebEmotionFlip_back_button_link_artikel');
		$collection->getBatchRequest()->setProductNumbers($element->getId(), [$productNumber]);
	}

	public function handle(ResolvedDataCollection $collection, Element $element, ShopContextInterface $context) {
		$product = current($collection->getBatchResult()->get($element->getId()));
		if (!empty($product)) {
			$element->getData()->set('nnwebEmotionFlip_button_link_produkt_id', $product->getId());
		}
	}
}