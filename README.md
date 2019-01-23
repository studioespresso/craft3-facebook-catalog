# Facebook Product Catalog

Link your products with your Facebook page

## Requirements

This plugin requires Craft CMS 3.0.0 or later, and works out of the box when you have [Craft Commerce](http://plugins.craftcms.com/commerce) installed.

If you want to use the plugin without commerce and/or with regular entries, have a look at the [Twig functions](#twig-function) 

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project
        composer require studioespresso/craft-facebook-catalog
        ./craft install/plugin craft-facebook-catalog

## Usage
Out of the box, the plugin will give you 1 feed with all your Craft Commerce products. If you need more control over which products show up in the feed, or you want multiple feeds, have a look at the have a look at the [Twig functions](#twig-function). 

## Twig function
If you want to use the plugin with regular entries, want to provide your own Element query or want to have mulitple feeds, have a look at these function.

### craft.catalog.render
The function takes an `ElementQuery` object (not the result, the query itself) and it applies

       {% set products = craft.products.limit(1) %}
       {{ craft.catalog.render(products) }}

The second parameter of the `render()` function should be an array that contains these field names and the names of the entry fields to which you want to map them.
       
       {{ craft.catalog.render(products, {
            title: 'fieldHandle',
            id: 'fieldHandle',
            description: 'fieldHandle',
            image_link: 'fieldHandle',
            brand: 'fieldHandle',
            price: 'fieldHandle',
            currency: 'USD' // ISO code of the currency you want to use
       }) }}

---
Brought to you by [Studio Espresso](https://studioespresso.co/en)
