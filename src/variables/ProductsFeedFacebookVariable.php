<?php
/**
 * Products feed - Facebook plugin for Craft CMS 3.x
 *
 * Link your products with your Facebook page
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\productsfeedfacebook\variables;

use craft\elements\db\ElementQuery;
use craft\web\View;
use studioespresso\productsfeedfacebook\ProductsFeedFacebook;

use Craft;

/**
 * @author    Studio Espresso
 * @package   ProductsFeedFacebook
 * @since     1.0.0
 */
class ProductsFeedFacebookVariable
{
    // Public Methods
    // =========================================================================
    public function render(ElementQuery $query = null, array $fields = null)
    {
        if (!$query) {
            return false;
        }
        if(!$fields) {
            $fields = ProductsFeedFacebook::getInstance()->getSettings();
        }
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $feed =  Craft::$app->view->renderTemplate('products-feed-facebook/products', [
            'products' => $query->all(),
            'settings' => $fields,
        ]);

        echo $feed;
        exit;
    }
}
