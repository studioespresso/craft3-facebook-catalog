<?php

namespace myprojecttests;

use Craft;
use craft\elements\User;
use FunctionalTester;


class SettingsFormCest
{

    /**
     * @var string
     */
    public $cpTrigger;

    /**
     * @var
     */
    public $currentUser;

    // Public methods
    // =========================================================================
    public function _before(FunctionalTester $I)
    {
        $this->currentUser = User::find()
            ->admin()
            ->one();
        $I->amLoggedInAs($this->currentUser);
        $this->cpTrigger = Craft::$app->getConfig()->getGeneral()->cpTrigger;
    }
    // Tests
    // =========================================================================
    public function SettingsWithCommerce(FunctionalTester $I)
    {
        $I->amOnPage('/' . $this->cpTrigger . '/settings/plugins/facebook-catalog');
        $I->see(' Enter a URL for your products feed ');
    }

    public function testSaveSettings(FunctionalTester $I)
    {
        $I->amOnPage('/' . $this->cpTrigger . '/settings/plugins/facebook-catalog');
        $I->see(' Enter a URL for your products feed ');

        $I->submitForm('#main-form', [
            'settings[shoppingFeed]' => '/feeds/products/facebook',
            'settings[brand]' => 'title',
            'settings[description]' => 'title',
            'settings[image_link]' => 'title',
        ]);
        $I->amOnPage('/' . $this->cpTrigger . '/settings/plugins');
        $I->amOnPage('/' . $this->cpTrigger . '/settings/plugins/facebook-catalog');
        $I->seeInField('settings[image_link]', 'title');
    }

    public function testRequiredFields(FunctionalTester $I)
    {
        $I->amOnPage('/' . $this->cpTrigger . '/settings/plugins/facebook-catalog');

        $I->submitForm('#main-form', [
        ]);
        $I->see('Description cannot be blank.');
        $I->see('Image Link cannot be blank.');

        $I->submitForm('#main-form', [
            'settings[brand]' => 'title'
        ]);
        $I->dontSee('Brand cannot be blank');

        $I->submitForm('#main-form', [
            'settings[description]' => 'title'
        ]);
        $I->dontSee('Description cannot be blank');
    }
}
