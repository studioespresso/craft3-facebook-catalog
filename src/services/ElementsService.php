<?php

namespace studioespresso\facebookcatalog\services;

use craft\base\Component;
use craft\commerce\elements\Product;
use craft\elements\db\ElementQuery;
use studioespresso\facebookcatalog\models\Settings;

class ElementsService extends Component
{
    public function getProducts(ElementQuery $query = null, Settings $settings = null)
    {
        if (!$query) {
            $query = Product::find()->limit(null);
        }
        if($settings->siteId) {
            $query->siteId($settings->siteId);
        }

        return $query->all();
    }
}
