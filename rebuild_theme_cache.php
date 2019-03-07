<?php

/* 
For Moodle 3.3+
This script should be added to ./admin/cli/ and called via commandline.
*/

define('CLI_SCRIPT', true);
require(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/lib/csslib.php');
$themename = $CFG->theme;
$theme= theme_config::load($themename);
$rev = theme_get_revision();
$candidatedir = "$CFG->localcachedir/theme/$rev/$themename/css";
$candidatesheet = "$candidatedir/all.css";
if (file_exists($candidatesheet)) {
        exit;
} else {
        $csscontent = $theme->get_css_content();
        make_localcache_directory('theme', false);
        css_store_css($theme, "$candidatedir/all.css", $csscontent);
}
