<?php
namespace AvoRed\Related\Listeners;

use AvoRed\Framework\Events\ProductAfterSave;
use AvoRed\Related\Models\Database\RelatedProduct;

class RelatedProductListener
{


    /**
     * Handle the event.
     *
     * @param  \AvoRed\Ecommerce\Events\ProductAfterSave  $event
     * @return void
     */
    public function handle(ProductAfterSave $event)
    {
        $productId          = $event->product->id;
        $relatedProducts    = isset($event->data['related']) ? $event->data['related'] : [];

        if(count($relatedProducts) > 0) {


            RelatedProduct::whereProductId($productId)->delete();

            foreach ($relatedProducts as $relatedId => $checkedValue) {

                if ($checkedValue == 1) {
                    RelatedProduct::create(['product_id' => $productId, 'related_id' => $relatedId]);
                }

            }
        }

    }
}