<?php
/**
 * Products feed - Facebook plugin for Craft CMS 3.x
 *
 * Link your products with your Facebook page
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\productsfeedfacebook;

use studioespresso\productsfeedfacebook\variables\ProductsFeedFacebookVariable;
use studioespresso\productsfeedfacebook\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class ProductsFeedFacebook
 *
 * @author    Studio Espresso
 * @package   ProductsFeedFacebook
 * @since     1.0.0
 *
 */
class ProductsFeedFacebook extends Plugin
{
    // Static Properties
    // =========================================================================
    public static $plugin;

    // Public Properties
    // =========================================================================
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules[$this->getSettings()->productsFeed] = 'products-feed-facebook/feed';
            }
        );
        
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('productsFeedFacebook', ProductsFeedFacebookVariable::class);
            }
        );
        
    }

    // Protected Methods
    // =========================================================================
    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'products-feed-facebook/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
