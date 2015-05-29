# Bootstrap Share Buttons

An often overlooked method of implementing social sharing buttons (without counters) on your site. Super lightweight without any external loaded resources, JavaScript, or CSS. Fully customisable using CSS and WordPress filters.

The social buttons are designed to work on sites already running a [Bootstrap](http://getbootstrap.com) theme with [FontAwesome](http://fontawesome.io) icons. The plugin does not automatically load any JavaScript or CSS resources. 

If you don't want to use Bootstrap or FontAwesome, you can still use this plugin by providing your own CSS or by using WordPress filters to change the button and icon classes.

## Installation

### Composer

`composer require bostondv/bootstrap-share-buttons`

### WordPress Plugin

_Coming soon to the WordPress.org plugin repository_. 

1. Upload the `bootstrap-share-buttons` folder to the `/wp-content/plugins/` directory
2. Activate the Bootstrap Share Buttons plugin through the 'Plugins' menu in WordPress

### Manually Include

[Download the repository](https://github.com/bostondv/bootstrap-share-buttons/archive/master.zip) and upload to your project. Include `bootstrap-share-buttons.php` in your project somewhere. 

## Usage

### Shortcode

Display social buttons anywhere shortcodes are supported.

`[bs-share-buttons twitter="bostondv" display="facebook,twitter,google,pinterest" style="both" type="default" size="md" /]`

### Function Call

Display social buttons anywhere within your PHP templates.

`<?php echo bootstrap_share_buttons( 'bostondv', 'facebook,twitter,google,pinterest', 'both', 'default', 'md' ); ?>`

### Parameters

**twitter** _Required_  
Your twitter account handle.

**display** _Optional_  
Comma separated list of share buttons you wish to display.

Options: `facebook`, `twitter`, `google`, `pinterest`, `linkedin`, `email`, `print`, or `all`.  
Default: `all`

**style** _Optional_  
Style of button to display.

Options:`icon`, `text`, or `both`.  
Default: `both`

**type** _Optional_  
Bootstrap button type.

Options: `default`, `primary`, `success`, `info`, `warning`, or `danger`.  
Default: `default`

**size** _Optional_  
Bootstrap button size.

Options: `xs`, `sm`, `md`, or `lg`.  
Default: `md`

### Filters

**bs\_share\_items**  
Allows you to change the share buttons displayed and any of their parameters.

Takes two arguments:  
`$displayed_items` _(Array)_ - All items that will be displayed.  
`$all_items` _(Array)_ - Array of all available social share buttons.

**bs\_share\_btn\_class**  
Allows you to change the share button classes.

Takes two arguments:  
`$classes` _(Array)_ - Array of all button classes.  
`$name` _(String)_ - Name of the share button eg. 'facebook'.

**bs\_share\_icon\_class**  
Allows you to change the share button icon classes.

Takes two arguments:  
`$classes` _(Array)_ - Array of all icon classes.  
`$name` _(String)_ - Name of the share button eg. 'facebook'.

**bs\_share\_text**  
Allows you to change the share button text. Used for the link `title` attribute, and the button text if `style` equals `text` or `both`.

Takes two arguments:  
`$text` _(String)_ - Text for the button.  
`$name` _(String)_ - Name of the share button eg. 'facebook'.

## About

Written by Boston Dell-Vandenberg of [Pomelo Design](http://www.pomelodesign.com). Pomelo Design is a web and mobile app development agency based in Toronto, Canada.