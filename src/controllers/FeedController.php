<?php
/**
 * Facebook Catalog plugin for Craft CMS 3.x
 *
 * Link your products with your Facebook page
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\facebookcatalog\controllers;

use craft\web\View;
use studioespresso\facebookcatalog\FacebookCatalog;

use Craft;
use craft\web\Controller;

/**
 * @author    Studio Espresso
 * @package   FacebookCatalog
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
        $settings = FacebookCatalog::getInstance()->getSettings();
        $products = FacebookCatalog::$plugin->elements->getProducts(null, $settings);
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);

        $headers = Craft::$app->response->headers;
        $headers->add('Content-Type', 'text/xml; charset=utf-8');
        return $this->renderTemplate('facebook-catalog/_products', [
            'products' => $products,
            'settings' => $settings
        ]);
    }

}
