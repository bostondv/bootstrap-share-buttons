<?php
/*
Plugin Name: Bootstrap Share Buttons for WordPress
Plugin URI: https://github.com/bostondv/bootstrap-share-buttons-wordpress
Description: Super lightweight Bootstrap social sharing buttons (without counters)
Version: 1.0.0
Author: bostondv
Author URI: http://pomelodesign.com
Text Domain: bs-share-buttons
Domain Path: /languages/
License: MIT
*/

/**
 * Main buttons function
 */
function bootstrap_share_buttons($twitter_name = null, $display = null, $style = 'both', $type = 'primary', $size = 'md') {

  // Get post content and urlencode it
  global $post;
  $browser_title_encoded = urlencode(trim(wp_title('', false, 'right')));
  $page_title_encoded = urlencode(get_the_title());
  $page_url_encoded = urlencode(get_permalink($post->ID));
  $page_excerpt_encoded = urlencode(strip_tags(get_the_excerpt()));
  $page_image_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
  if (!$page_image_url) {
    ob_start();
    ob_end_clean();
    $page_attached_media = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if ($page_attached_media) {
      $page_image_url = $matches[1][0];
    }
  }
  $page_image_url_encoded = urlencode($page_image_url);

  // Create share items array
  $share_items = array();

  // set each item
  $items = array(
    'facebook' => array(
      'name' => 'facebook',
      'href' => 'http://www.facebook.com/sharer/sharer.php?u=' . $page_url_encoded . '&amp;t=' . $browser_title_encoded,
      'text' => __('Share on Facebook', 'bs-share-buttons')
    ),
    'twitter' => array(
      'name' => 'twitter',
      'href' => 'http://twitter.com/share?text=' . $page_title_encoded . '&amp;url=' . $page_url_encoded . '&amp;via=' . $twitter_name,
      'text' => __('Share on Twitter', 'bs-share-buttons')
    ),
    'google' => array(
      'name' => 'google',
      'href' => 'http://plus.google.com/share?url=' . $page_url_encoded,
      'text' => __('Share on Google+', 'bs-share-buttons')
    ),
    'pinterest' => array(
      'name' => 'pinterest',
      'href' => 'http://www.pinterest.com/pin/create/button/?url=' .$page_url_encoded . '&amp;description=' . $page_excerpt_encoded . '&amp;media=' . $page_image_url_encoded,
      'text' => __('Share on Pinterest', 'bs-share-buttons')
    )
  );

  // Test whether to display each item
  if ($display) {
    $display_array = explode(',', $display);
    foreach ($display_array as $item) {
      if (in_array($item, $display_array)) {
        array_push($share_items, $items[$item]);
      }
    }
  } else {
    $share_items = $items;
  }

  $share_items = apply_filters('bs_share_items', $share_items);

  // Create output
  if ($share_items) {
    
    $share_output = '<ul class="bs-share list-inline">'."\r\n";
    foreach ($share_items as $item) {
      $btn_classes = array('btn', 'btn-' . $item['name']);
      $icon_classes = array('fa fa-fw fa-' . $item['name']);
      if ($size) $btn_classes[] = 'btn-' . $size;
      if ($type) $btn_classes[] = 'btn-' . $type;
      if ($type !== 'default') $icon_classes[] = 'fa-inverse';
      if ($size === 'lg') $icon_classes[] = 'fa-lg';
      $share_output .= '<li class="bs-share-item">'."\r\n";
      $share_output .= '<a class="' . implode(apply_filters('bs_share_btn_class', $btn_classes, $item), ' ') . '" href="' . $item['href'] . '" rel="nofollow" target="_blank" title="' . $item['text'] . '">';
      if ($style === 'icon' || $style === 'both') {
        $share_output .= '<i class="' . implode(apply_filters('bs_share_icon_class', $icon_classes, $item), ' ') . '"></i>';
      }
      if ($style === 'both') {
        $share_output .= ' ';
      }
      if ($style === 'text' || $style === 'both') {
        $share_output .= apply_filters('bs_share_text', $item['text'], $item); 
      }
      $share_output .= '</a>'."\r\n";
      $share_output .= '</li>'."\r\n";
    }
    $share_output .= '</div>'."\r\n";
    echo $share_output;
  }

}

/**
 * Shortcode to output buttons
 */
function bootstrap_share_buttons_shortcode($atts, $content = null) {
  extract(shortcode_atts(array(
    'twitter' => '',
    'display' => 'facebook,twitter,google,pinterest',
    'style' => 'both',
    'type' => 'default',
    'size' => 'md'
  ), $atts));
  ob_start();
  bootstrap_share_buttons($twitter, $display, $style, $type, $size);
  $output_string = ob_get_contents();
  ob_end_clean();
  return force_balance_tags($output_string);
}
add_shortcode('bs-share-buttons', 'bootstrap_share_buttons_shortcode');
