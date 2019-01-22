<?php

namespace studioespresso\productsfeedfacebook\services;

use craft\base\Component;
use craft\commerce\elements\Product;
use craft\elements\db\ElementQuery;

class ElementsService extends Component
{
    public function getProducts(ElementQuery $query = null)
    {
        if ($query) {
            $products = $query->all();
        } else {
            $products = Product::find()->limit(null)->all();
        }
        return $products;
    }
}
