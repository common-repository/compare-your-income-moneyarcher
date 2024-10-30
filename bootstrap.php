<?php

if (!class_exists('ReduxFramework') && file_exists( CYI_PATH . '/optionpanel/ReduxCore/framework.php')) {
    require_once CYI_PATH . 'optionpanel/ReduxCore/framework.php';
}
 
if (!isset($redux_demo) && file_exists( CYI_PATH . '/optionpanel/config.php')) {
    require_once CYI_PATH . 'optionpanel/config.php';
 }

require_once CYI_PATH . 'display.php';
