<?php
/**
 * Theme Functions.
 *
 * @package   Boilerplate\Theme
 * @author    Craig Simpson <craig.simpson@intimation.uk>
 * @copyright Copyright (c) 2019, Intimation Creative
 * @license   MIT
 * 
 *
 *   _       _   _                 _   _
 *  (_)_ __ | |_(_)_ __ ___   __ _| |_(_) ___  _ __
 *  | | '_ \| __| | '_ ` _ \ / _` | __| |/ _ \| '_ \
 *  | | | | | |_| | | | | | | (_| | |_| | (_) | | | |
 *  |_|_| |_|\__|_|_| |_| |_|\__,_|\__|_|\___/|_| |_|
 *
 */

namespace Boilerplate\Theme;

define( 'CHILD_THEME_NAME', 'Boilerplate' );
define( 'CHILD_THEME_URL', 'https://intimation.dev/boilerplate/theme' );
define( 'CHILD_THEME_VERSION', '0.1.0' );

load_child_theme_textdomain( 'boilerplate', get_stylesheet_directory() . '/languages' );

include_once __DIR__ . '/includes/theme-setup.php';
include_once __DIR__ . '/includes/theme-markup.php';
include_once __DIR__ . '/includes/theme-assets.php';
