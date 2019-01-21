<?php
/**
 * Products feed - Facebook plugin for Craft CMS 3.x
 *
 * Link your products with your Facebook page
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\productsfeedfacebook\models;

use studioespresso\productsfeedfacebook\ProductsFeedFacebook;

use Craft;
use craft\base\Model;

/**
 * @author    Studio Espresso
 * @package   ProductsFeedFacebook
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $productsFeed = '/feeds/products/facebook';

    public $id;

    public $title;

    public $availability;

    public $description;

    public $image_link;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['productsFeed', 'required'],
            ['description', 'required'],
            ['image_link', 'required'],
        ];
    }
}
