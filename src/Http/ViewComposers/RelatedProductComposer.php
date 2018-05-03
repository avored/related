<?php
namespace AvoRed\Related\Http\ViewComposers;

use AvoRed\Framework\Repository\Product;
use AvoRed\Related\DataGrid\RelatedProduct;
use Illuminate\View\View;

class RelatedProductComposer {

    /**
     * The Product repository implementation.
     *
     * @var \AvoRed\Framework\Repository\Product
     */
    protected $product;

    /**
     * Create a new profile composer.
     *
     * @param  \AvoRed\Framework\Repository\Product  $product
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $productId = $view->offsetGet('model')->id;
        $productModel = $this->product->model()->query();
        $relatedProductGrid = new RelatedProduct($productModel, $productId);

        $view->with('dataGrid', $relatedProductGrid->dataGrid);
    }

}