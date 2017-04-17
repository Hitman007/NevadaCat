<?php
/*
Plugin Name: Nevada Cat
Plugin URI: http://nevadacathouse.biz/
Description: 
Version: 1.0
Author: Jim Maguire
Author URI:
*/

namespace NevadaCat;

//die('NevadaCat plugin is active!');

require_once 'NevadaCat/NevadaCatPlugin.class.php';

$NevadaCatPlugin = new NevadaCatPlugin;
$NevadaCatPlugin->activateFelineImageGridFeature();
$NevadaCatPlugin->activateFelineCPT_Feature();
$NevadaCatPlugin->activateAddCatShortCodeFeature();
$NevadaCatPlugin->activateAddCatLoginRedirectFeature();
$NevadaCatPlugin->enqueueJSscripts();

register_activation_hook( __FILE__, array( $NevadaCatPlugin, 'doPluginActivationActions' ) );
register_deactivation_hook( __FILE__, array( $NevadaCatPlugin, 'doPluginDeactivationActions' ) );
