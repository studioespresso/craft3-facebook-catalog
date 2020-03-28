# Facebook Product Catalog

Get your products or entries into Facebook Catalog, on your Facebook page and on your Instagram account.

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
Out of the box, the plugin will give you 1 feed with all your Craft Commerce products, using the default variant for each product.

If you need more control over which products show up in the feed, or you want multiple feeds, have a look at the have a look at the [Twig functions](#twig-function). 


## Twig function
If you want to use the plugin with regular entries, want to provide your own Element query or want to have mulitple feeds, have a look at these function:

### Products - craft.catalog.products
Works with any **Commerce Products** element query, and will use the default variant for each product

       {% set products = craft.products.limit(1) %}
       {{ craft.catalog.products(query) }}

### Entries - craft.catalog.entries
Works with any element query

       {% set query = craft.entries.section('books') %}
       {{ craft.catalog.entries(query) }}

Both function take an `ElementQuery` as first parameter and will use the fields mapped in the plugin settings.

A second parameter (required) can be added with that contains these fixed field names and the names of the entry fields to which you want to map them.
       
       {{ craft.catalog.entries(products, {
            title: 'fieldHandle',
            id: 'fieldHandle',
            description: 'fieldHandle',
            image_link: 'fieldHandle',
            brand: 'fieldHandle',
            price: 'fieldHandle',
            currency: 'USD' // ISO code of the currency you want to use,
            googleProductCategory: 'fieldHandle'
       }) }}

If each of these fields are not pressent in the array, the feed will fail to validated and throw an expection. 

---
Brought to you by [Studio Espresso](https://studioespresso.co/en)
