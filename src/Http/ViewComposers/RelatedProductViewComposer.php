<?php
namespace AvoRed\Related\Http\ViewComposers;

use AvoRed\Related\DataGrid\RelatedProduct;
use Illuminate\View\View;

class RelatedProductViewComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $dataGrid = new RelatedProduct(RelatedProduct::query());
        $view->with('related', $dataGrid->dataGrid);
    }

}