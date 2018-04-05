<?php

namespace AvoRed\Related\Repository;

use AvoRed\Related\Models\Database\RelatedProduct;
use AvoRed\Framework\Repository\AbstractRepository;

class Related extends AbstractRepository
{
    public function model()
    {
        return new RelatedProduct();
    }

}
