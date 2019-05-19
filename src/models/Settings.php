<?php
/**
 * Facebook Catalog plugin for Craft CMS 3.x
 *
 * Link your products with your Facebook page
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\facebookcatalog\models;

use studioespresso\facebookcatalog\FacebookCatalog;

use Craft;
use craft\base\Model;

/**
 * @author    Studio Espresso
 * @package   FacebookCatalog
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

    public $id = 'sku';

    public $siteId;

    public $title = 'title';

    public $price = 'price';

    public $availability = 'in stock';

    public $description;

    public $image_link;

    public $brand;

    public $brandCustom;

    public $currencyIso;

    public $googleProductCategory;

    public $googleProductCategoryCustom;

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
            ['brand', 'required'],
        ];
    }
}
