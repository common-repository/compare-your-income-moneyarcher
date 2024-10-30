<?php

/*
Plugin Name: Compare Your Income - MoneyArcher
Description: How much you earns compared to famous people?
Author: MD AL AMIN
Version: 2.0.0
*/

define( 'CYI_PATH' , plugin_dir_path ( __FILE__ ) );
define ( 'CYI_TITLE', 'Compare Your Income - MoneyArcher' );
define ( 'CYI_VERSION', '2.0.0' );
$maxPeople = 5;
$compareTabs = [
    'one' => 'One',
    'two' => 'Two',
    'three' => 'Three',
    'four' => 'Four',
    'five' => 'Five',
    'six' => 'Six',
    'seven' => 'Seven',
    'eight' => 'Eight',
    'nine' => 'Nine',
    'ten' => 'Ten',
    'eleven' => 'Eleven',
    'twelve' => 'Twelve',
    'thirteen' => 'Thirteen',
    'fourteen' => 'Fourteen',
    'fifteen' => 'Fifteen'

];

require_once CYI_PATH . 'bootstrap.php';

function cyi_load_css_js() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'cyi', $plugin_url . 'css/style.css', '', CYI_VERSION );
    wp_enqueue_script("jquery");
    wp_enqueue_script('cyi-p', $plugin_url . 'js/progress.js', ['jquery'], CYI_VERSION, true);
    wp_enqueue_script('cyi', $plugin_url . 'js/script.js', ['jquery'], CYI_VERSION, true);
}
add_action( 'wp_enqueue_scripts', 'cyi_load_css_js' );
