<?php
namespace AvoRed\Related\Http\ViewComposers;

use AvoRed\Related\DataGrid\RelatedProduct;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\View\View;

class RelatedProductComposer {


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $productId      = $view->offsetGet('model')->id;
        $productModel   = Product::query();
        $relatedProductGrid = new RelatedProduct($productModel, $productId);

        $view->with('dataGrid', $relatedProductGrid->dataGrid);
    }

}