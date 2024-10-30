<?php

function cyi_html($attrs) {
    global $compareTabs;
    global $opt_name;

    $tab = 'one';
    if( is_array($attrs) && count($attrs) > 0) {
        $tempTab = strtolower($attrs[0]);
        if ( array_key_exists($tempTab, $compareTabs) ) {
            $tab = $tempTab;
        }
    }

    $redux = get_option( $opt_name );

    $html = '';
    $html .= '<div class="cyi_html">';

    $html .= '<div class="cyi_title">';
    $html .= $redux['cyi-headline'];
    $html .= '</div>';

    $html .= '<div class="cyi_desc">';
    $html .= $redux['cyi-description'];
    $html .= '</div>';

    $html .= '<div class="cyi_input">';
    $curr = $redux['currency'] == 'other' ? $redux['currency-other'] : $redux['currency'];
    $html .= '<input type="number" id="cyi_input_text" value="" placeholder="'. $curr .'" />';
    $html .= '</div>';

    $html .= '<div class="cyi_main">';

    global $maxPeople;

    $html .= '<div class="cyi-names">';
    for($i = 1; $i <= $maxPeople; $i++):
        $name = 'cyi-p-'. $i .'-name_' . $tab;
        $html .= '<div class="cyi-name">'. $redux[$name] .'</div>';
    endfor;
    $html .= '</div>';

    $html .= '<div class="cyi-faces">';
    for($i = 1; $i <= $maxPeople; $i++):
        $face = 'cyi-p-'. $i .'-media_' . $tab;
        $sal = 'cyi-p-'. $i .'-salary_' . $tab;
        $parcent = rand(50,100);
        $html .= '<div class="cyi-bar_'.$i.'" data-sal='.$redux[$sal].' data-parcent="'.$parcent.'" data-img="'. $redux[$face]['thumbnail'] .'"></div>';

    endfor;
    $html .= '</div>';

    $html .= '<div class="cyi-parcentages">';
    for($i = 1; $i <= $maxPeople; $i++):
        $html .= '<div class="cyi-parcentage"><span class="cyi-parcentage-number_'.$i.'">0</span><br />'. $redux['cyi-time'] .'</div>';
    endfor;
    $html .= '</div>';

    
    $html .= '</div>';

    if ( $redux['cyi-checkbox'] ) {
        $html .= '<div class="cyi_credit">';
        $html .= 'Powered by <a href="//moneyArcher.com" target="_blank">MoneyArcher.com</a>';
        $html .= '</div>';
    }

    $html .= '</div>';
    $html .= '<input type="hidden" id="cyiGraphColor" value="'. $redux['color'] .'" />';
    $html .= '<input type="hidden" id="cyiSalTime" value="'. $redux['cyi-sal-time'] .'" />';
    
    return $html;
}

global $opt_name;
$redux = get_option( $opt_name );
add_shortcode( $redux['cyi-shortcode'], 'cyi_html' );
