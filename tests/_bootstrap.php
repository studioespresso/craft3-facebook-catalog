<?php

use craft\test\TestSetup;

ini_set('date.timezone', 'UTC');

define('CRAFT_STORAGE_PATH', __DIR__ . '/_craft/storage');
define('CRAFT_TEMPLATES_PATH', __DIR__ . '/_craft/templates');
define('CRAFT_CONFIG_PATH', __DIR__ . '/_craft/config');
define('CRAFT_MIGRATIONS_PATH', __DIR__ . '/_craft/migrations');
define('CRAFT_TRANSLATIONS_PATH', __DIR__ . '/_craft/translations');

// Use absolute path if the plugin directory is a symlink
define('CRAFT_VENDOR_PATH', getenv('VENDOR'));

$devMode = true;

TestSetup::configureCraft();
