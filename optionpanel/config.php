<?php

if ( ! class_exists( 'Redux' ) ) {
    return;
}

$opt_name = "cyi";

$args = array(
    'opt_name' => $opt_name,
    'display_name' => CYI_TITLE,
    'display_version' => CYI_VERSION,
    'menu_type' => 'menu',
    'allow_sub_menu' => true,
    'menu_title' => CYI_TITLE,
    'page_title' => CYI_TITLE,
    'google_api_key' => '',
    'google_update_weekly' => false,
    'async_typography' => true,
    'admin_bar' => true,
    'admin_bar_icon' => '',
    'admin_bar_priority' => 50,
    'global_variable' => $opt_name,
    'dev_mode' => false,
    'update_notice' => false,
    'customizer' => true,
    'page_priority' => null,
    'page_parent' => 'themes.php',
    'page_permissions' => 'manage_options',
    'menu_icon' => '',
    'last_tab' => '',
    'page_icon' => 'icon-themes',
    'page_slug' => 'cyi-settings',
    'save_defaults' => true,
    'default_show' => false,
    'default_mark' => '',
    'show_import_export' => true
);

$args['footer_credit'] = '<span id="footer-thankyou">Thank you for using '. CYI_TITLE .' plugin v'.CYI_VERSION.'</span>';

Redux::setArgs( $opt_name, $args );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Settings', 'cyi' ),
    'id'               => 'settings',
    'desc'             => __( 'Plugin setting fields!', 'cyi' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-wrench',

    'fields'           => array(
        array(
            'id'       => 'cyi-headline',
            'type'     => 'text',
            'title'    => __( 'Headline', 'cyi' ),
            'default'  => 'How much they earn compared to you',
        ),
        array(
            'id'       => 'cyi-description',
            'type'     => 'textarea',
            'title'    => __( 'Description', 'cyi' ),
            'default'  => 'Put in your salary before taxes, and see how long it takes the stars to earn the same as you',
        ),
        array(
            'id'       => 'currency',
            'type'     => 'radio',
            'title'    => __( 'Choose Currency', 'cyi' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '$' => '$',
                '€' => '€',
                '£' => '£',
                'other' => 'Other',
            ),
            'default'  => '$'
        ),
        array(
            'id'       => 'currency-other',
            'type'     => 'text',
            'title'    => 'Your Currency',
            'required' => array('currency','equals','other'),
        ),
        array(
            'id'       => 'cyi-sal-time',
            'type'     => 'select',
            'title'    => __( 'Salary per', 'cyi' ),
            'options'  => array(
                '31'   => 'Month (31 days)',
                '365'  => 'Year (365 days)',
            ),
            'default'  => '31',
            'validate' => 'not_empty',
        ),
        array(
            'id'       => 'cyi-time',
            'type'     => 'text',
            'title'    => __( 'Time description', 'cyi' ),
            'default'  => 'Days',
        ),
        array(
            'id'       => 'color',
            'type'     => 'color',
            'output'   => array( '.cyi' ),
            'title'    => __( 'Graph Color', 'cyi' ),
            'subtitle' => __( 'Pick a color for the graph.', 'cyi' ),
            'default'  => '#042e54',
        ),
    )
) );


global $compareTabs;

foreach($compareTabs as $cKey => $cVal) {

$peopleToCompareFields = [];
global $maxPeople;

for($i = 1; $i <= $maxPeople; $i++) {
    $info = [
        'id'     => 'opt-notice-success_' . $i . '_' . $cKey,
        'type'   => 'info',
        'notice' => false,
        'style'  => 'success',
        'icon'   => 'el el-info-circle',
        'title'  => __( 'Person '. $i, 'cyi' ),
    ];

    $name = [
        'id'       => 'cyi-p-'. $i .'-name' . '_' . $cKey,
        'type'     => 'text',
        'title'    => __( 'Name', 'cyi' ),
    ];

    $media = [
        'id'       => 'cyi-p-'. $i .'-media' . '_' . $cKey,
        'type'     => 'media',
        'title'    => __( 'Media', 'cyi' ),
    ];

    $salary = [
        'id'       => 'cyi-p-'. $i .'-salary' . '_' . $cKey,
        'type'     => 'text',
        'title'    => __( 'Salary', 'cyi' ),
        'validate' =>  'numeric',
    ];

    array_push($peopleToCompareFields, $info);
    array_push($peopleToCompareFields, $name);
    array_push($peopleToCompareFields, $media);
    array_push($peopleToCompareFields, $salary);
    unset($info);
    unset($name);
    unset($media);
    unset($salary);
}

Redux::setSection( $opt_name, array(
    'title'            => __( 'Compare [' . $cVal . ']', 'cyi' ),
    'id'               => 'people-to-compare_' . $cKey,
    'customizer_width' => '400px',
    'icon'             => 'el el-person',
    'fields'     => $peopleToCompareFields,
) );
}


Redux::setSection( $opt_name, array(
    'title'            => __( 'Powered by website', 'cyi' ),
    'id'               => 'credit',
    'customizer_width' => '400px',
    'icon'             => 'el el-bulb',
    'fields'           => array(
        array(
            'id'       => 'cyi-checkbox',
            'type'     => 'checkbox',
            'title'    => __( 'Powered by website Option', 'cyi' ),
            'subtitle' => __( 'Support us by putting our link on your website', 'cyi' ),
            'desc'     => 'Enabling this option will show "Powered by <a href="//moneyArcher.com" target="_blank">MoneyArcher.com</a>" at the bottom of the graph',
            'default'  => '1'// 1 = on | 0 = off
        ),
    )
) );


global $opt_name;
$redux = get_option( $opt_name );
Redux::setSection( $opt_name, array(
    'title'            => __( 'Shortcode', 'cyi' ),
    'id'               => 'shortcode',
    'customizer_width' => '400px',
    'icon'             => 'el el-adjust-alt',
    'fields'           => array(
        [
            'id'     => 'opt-notice-success_shortcode',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'success',
            'icon'   => 'el el-info-circle',
            'title'  => __( 'Shortcode:','cyi' ),
            'desc'   => 'Use the input text bellow as shortcode with Tab number. Tab number included in brackets [] after the tab. i.e [' . $redux['cyi-shortcode'] .' One], [' . $redux['cyi-shortcode'] .' Two], [' . $redux['cyi-shortcode'] .' Three] etc.',
        ],
        array(
            'id'       => 'cyi-shortcode',
            'type'     => 'text',
            'title'    => __( 'Shortcode to display on front-end', 'cyi' ),
            'desc'     => 'Characters not allowed: space, /, \' (Avoid special characters)',
            'default'  => 'compare-your-income',
            'validate' =>  'no_special_chars',
        ),
    )
) );
