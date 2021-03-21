<?php

namespace Tecala\Theme;

define( 'CHILD_THEME_NAME', 'Tecala' );
define( 'CHILD_THEME_URL', '' );
define( 'CHILD_THEME_VERSION', '0.1.0' );

load_child_theme_textdomain( 'tecala', get_stylesheet_directory() . '/languages' );

include_once __DIR__ . '/includes/theme-setup.php';
include_once __DIR__ . '/includes/theme-markup.php';
include_once __DIR__ . '/includes/theme-assets.php';
