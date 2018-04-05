<?php

namespace AvoRed\Related\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;
use AvoRed\Related\Repository\Related;

class RelatedProduct
{

    /**
     * Related Product Repository
     *
     *
     * @var \AvoRed\Related\Repository\Related $related
     */
    public $related;


    /**
     * Data Grid Manager Object
     *
     *
     * @var \AvoRed\Framework\DataGrid\Manager $dataGrid
     */
    public $dataGrid;

    public function __construct($model, Related $related, $productId)
    {
        $this->related  = $related;
        $dataGrid       = DataGrid::make('admin_product_related_composer');


        $dataGrid->model($model)
            ->linkColumn('checkbox', ['label' => ""],function ($model ) use ($related, $productId){


                $relatedModel = $related->model()->whereProductId($productId)->whereRelatedId($model->id)->first();

                $checked = "";
                if(null != $relatedModel) {
                    $checked = "checked ";
                }
                return "<input type='checkbox' {$checked} value='1'  name='related[".$model->id."]' />";
            })
            ->column('id', ['sortable' => true])
            ->column('name', ['label' => 'Name'])
            ->pageName('related_page')
            ;

        $this->dataGrid = $dataGrid;
    }
}
