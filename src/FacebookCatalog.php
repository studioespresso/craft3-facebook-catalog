<?php
/**
 * Facebook Catalog plugin for Craft CMS 3.x
 *
 * Link your products with your Facebook page
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\facebookcatalog;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\web\twig\variables\CraftVariable;
use craft\web\UrlManager;
use studioespresso\facebookcatalog\models\Settings;
use studioespresso\facebookcatalog\services\ElementsService;
use studioespresso\facebookcatalog\variables\FacebookCatalogVariable;
use craft\commerce\Plugin as CommercePlugin;
use yii\base\Event;

/**
 * Class FacebookCatalog
 *
 * @author    Studio Espresso
 * @package   FacebookCatalog
 * @since     1.0.0
 *
 * @property ElementsService $elements
 */
class FacebookCatalog extends Plugin
{
    // Static Properties
    // =========================================================================
    public static $plugin;

    // Public Properties
    // =========================================================================
    public string $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->_registerRoutes();
        $this->_registerVariables();
    }

    // Protected Methods
    // =========================================================================
    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): Model
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        $fields = array_map(function($field) {
            return $fields[$field->id] = $field->name;
        }, Craft::$app->getFields()->getAllFields());
        return Craft::$app->view->renderTemplate(
            'facebook-catalog/settings',
            [
                'settings' => $this->getSettings(),
                'fields' => Craft::$app->getFields()->getAllFields()
            ]
        );
    }

    // Private Methods
    // =========================================================================
    private function _registerRoutes()
    {
        if (Craft::$app->getPlugins()->isPluginEnabled('commerce')) {
            Event::on(
                UrlManager::class,
                UrlManager::EVENT_REGISTER_SITE_URL_RULES,
                function (RegisterUrlRulesEvent $event) {
                    $event->rules[$this->getSettings()->productsFeed] = 'facebook-catalog/feed';
                }
            );
        }
    }

    private function _registerVariables()
    {
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('catalog', FacebookCatalogVariable::class);
            }
        );
    }
}
