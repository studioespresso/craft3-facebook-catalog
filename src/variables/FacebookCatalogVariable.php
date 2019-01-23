<?php
/**
 * Facebook Catalog plugin for Craft CMS 3.x
 *
 * Link your products with your Facebook page
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\facebookcatalog\variables;

use craft\elements\db\ElementQuery;
use craft\web\View;
use studioespresso\facebookcatalog\FacebookCatalog;

use Craft;

/**
 * @author    Studio Espresso
 * @package   FacebookCatalog
 * @since     1.0.0
 */
class FacebookCatalogVariable
{
    // Public Methods
    // =========================================================================
    public function render(ElementQuery $query = null, array $fields = null)
    {
        if (!$query) {
            return false;
        }
        if(!$fields) {
            $fields = FacebookCatalog::getInstance()->getSettings();
        }
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $feed =  Craft::$app->view->renderTemplate('facebook-catalog/products', [
            'products' => $query->all(),
            'settings' => $fields,
        ]);

        echo $feed;
        exit;
    }
}
