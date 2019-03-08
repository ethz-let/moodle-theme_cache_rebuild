<?php

/* 
For Moodle 3.3+
This script should be added to ./admin/cli/ and called via commandline.
1. Uncomment the below define('CLI_SCRIPT', true); when in prodcution.
2. Uncomment the below require(__DIR__.'/../../config.php'); when in prodcution.
*/

//define('CLI_SCRIPT', true);
//require(__DIR__.'/../../config.php');
require('config.php');
require_once($CFG->dirroot.'/lib/csslib.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$themename = $CFG->theme;
$theme= theme_config::load($themename);
$rev = theme_get_revision();
$candidatedir = "$CFG->localcachedir/theme/$rev/$themename/css";
$candidatesheet = "$candidatedir/all.css";
if (file_exists($candidatesheet)) {
        echo "Not Generated. Theme compiled CSS was already generated: " . $candidatesheet ;
        exit;
} else {
        $csscontent = $theme->get_css_content();
        make_localcache_directory('theme', false);
        css_store_css($theme, "$candidatedir/all.css", $csscontent);
        echo "Generated. Theme compiled CSS is generated: " . $candidatesheet;
}
