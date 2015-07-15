<?php
/*
Plugin Name: Bootstrap Share Buttons
Plugin URI: https://github.com/bostondv/bootstrap-share-buttons
Description: Super lightweight Bootstrap + FontAwesome social sharing buttons (without counters)
Version: 1.0.3
Author: bostondv
Author URI: http://pomelodesign.com
Text Domain: bs-share-buttons
Domain Path: /languages/
License: MIT
License URI: http://opensource.org/licenses/MIT
*/

load_plugin_textdomain('bs-share-buttons', false, basename(dirname( __FILE__ ) ) . '/languages');

/**
 * Main buttons function
 */
if (!function_exists('bootstrap_share_buttons')) {
  function bootstrap_share_buttons($twitter_name = null, $display = null, $style = 'both', $type = 'primary', $size = 'md') {

    // Get post content and urlencode it
    global $post;
    $browser_title_encoded = rawurlencode(trim(wp_title('', false, 'right')));
    $page_title_encoded = rawurlencode(get_the_title());
    $page_url_encoded = rawurlencode(get_permalink($post->ID));
    $page_excerpt_encoded = rawurlencode(strip_tags(get_the_excerpt()));
    $page_image_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
    if (!$page_image_url) {
      ob_start();
      ob_end_clean();
      $page_attached_media = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
      if ($page_attached_media) {
        $page_image_url = $matches[1][0];
      }
    }
    $page_image_url_encoded = rawurlencode($page_image_url);

    // Create share items array
    $display_items = array();

    // Set each item
    $items = array(
      'facebook' => array(
        'name' => 'facebook',
        'href' => 'http://www.facebook.com/sharer/sharer.php?u=' . $page_url_encoded . '&amp;t=' . $browser_title_encoded,
        'text' => __('Share', 'bs-share-buttons'),
        'icon' => 'fa-facebook'
      ),
      'twitter' => array(
        'name' => 'twitter',
        'href' => 'http://twitter.com/share?text=' . $page_title_encoded . '&amp;url=' . $page_url_encoded . '&amp;via=' . $twitter_name,
        'text' => __('Tweet', 'bs-share-buttons'),
        'icon' => 'fa-twitter'
      ),
      'google' => array(
        'name' => 'google',
        'href' => 'http://plus.google.com/share?url=' . $page_url_encoded,
        'text' => __('Share', 'bs-share-buttons'),
        'icon' => 'fa-google-plus'
      ),
      'pinterest' => array(
        'name' => 'pinterest',
        'href' => 'http://www.pinterest.com/pin/create/button/?url=' .$page_url_encoded . '&amp;description=' . $page_excerpt_encoded . '&amp;media=' . $page_image_url_encoded,
        'text' => __('Pin It', 'bs-share-buttons'),
        'icon' => 'fa-pinterest'
      ),
      'email' => array(
        'name' => 'email',
        'href' => 'mailto:email@domain.com?subject=' . $page_title_encoded . '&amp;body=' . $page_excerpt_encoded . '%0A%0ALink%3A%20' . $page_url_encoded,
        'text' => __('Email', 'bs-share-buttons'),
        'icon' => 'fa-envelope'
      ),
      'print' => array(
        'name' => 'print',
        'href' => 'javascript:print()',
        'text' => __('Print', 'bs-share-buttons'),
        'icon' => 'fa-print'
      ),
      'linkedin' => array(
        'name' => 'linkedin',
        'href' => 'http://www.linkedin.com/shareArticle?mini=true&url=' . $page_url_encoded . '&amp;title=' . $browser_title_encoded . '&amp;ro=false&amp;summary=' . $page_excerpt_encoded,
        'text' => __('Share', 'bs-share-buttons'),
        'icon' => 'fa-linkedin'
      ),
    );

    // Test whether to display each item
    if (!$display || $display === 'all') {
      $display_items = $items;
    } else {
      $display_array = explode(',', $display);
      foreach ($display_array as $item) {
        if (array_key_exists($item, $items)) {
          array_push($display_items, $items[$item]);
        }
      }
    }

    $display_items = apply_filters('bs_share_items', $display_items, $items);

    // Create output
    $output = '';

    if ($display_items) {
      $output = '<ul class="bs-share list-inline">'."\r\n";
      foreach ($display_items as $item) {
        $target = '';
        $btn_classes = array('btn', 'btn-' . $item['name']);
        $icon_classes = array('fa', 'fa-fw', $item['icon']);
        if ($size) $btn_classes[] = 'btn-' . $size;
        if ($type) $btn_classes[] = 'btn-' . $type;
        if (in_array($type, array('primary', 'success', 'info', 'warning', 'danger'))) $icon_classes[] = 'fa-inverse';
        if ($size === 'lg') $icon_classes[] = 'fa-lg';
        if ($item['name'] !== 'email') $target = 'target="_blank" ';
        $output .= '<li class="bs-share-item">'."\r\n";
        $output .= '<a class="' . implode(apply_filters('bs_share_btn_class', $btn_classes, $item['name']), ' ') . '" href="' . $item['href'] . '" rel="nofollow" ' . $target . 'title="' . apply_filters('bs_share_text', $item['text'], $item['name']) . '">';
        if ($style === 'icon' || $style === 'both') {
          $output .= '<i class="' . implode(apply_filters('bs_share_icon_class', $icon_classes, $item['name']), ' ') . '"></i>';
        }
        if ($style === 'both') {
          $output .= ' ';
        }
        if ($style === 'text' || $style === 'both') {
          $output .= apply_filters('bs_share_text', $item['text'], $item['name']); 
        }
        $output .= '</a>'."\r\n";
        $output .= '</li>'."\r\n";
      }
      $output .= '</ul>'."\r\n";
    }

    return $output;
  }
}

/**
 * Shortcode to output buttons
 */
if (!function_exists('bootstrap_share_buttons_shortcode')) {
  function bootstrap_share_buttons_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
      'twitter' => '',
      'display' => 'all',
      'style' => 'both',
      'type' => 'default',
      'size' => 'md'
    ), $atts));
    ob_start();
    echo bootstrap_share_buttons($twitter, $display, $style, $type, $size);
    $output_string = ob_get_contents();
    ob_end_clean();
    return force_balance_tags($output_string);
  }
  add_shortcode('bs-share-buttons', 'bootstrap_share_buttons_shortcode');
}
