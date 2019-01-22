<?php
/**
 * Products feed - Facebook plugin for Craft CMS 3.x
 *
 * Link your products with your Facebook page
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\productsfeedfacebook\controllers;

use craft\web\View;
use studioespresso\productsfeedfacebook\ProductsFeedFacebook;

use Craft;
use craft\web\Controller;

/**
 * @author    Studio Espresso
 * @package   ProductsFeedFacebook
 * @since     1.0.0
 */
class FeedController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index'];

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $products = ProductsFeedFacebook::$plugin->elements->getProducts();
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        return $this->renderTemplate('products-feed-facebook/products', [
            'products' => $products,
            'settings' => ProductsFeedFacebook::getInstance()->getSettings()
        ]);
    }

}
