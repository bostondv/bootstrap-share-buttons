# Bootstrap Share Buttons for WordPress

An often overlooked method of implementing social sharing buttons (without counters) on your site. Super lightweight without any external loaded resources, JavaScript, or CSS. Fully customisable using CSS and WordPress filters.

The social buttons are designed to work on sites already running a [Bootstrap](http://getbootstrap.com) theme with [FontAwesome](http://fontawesome.io) icons. The plugin does not automatically load any JavaScript or CSS resources. 

If you don't want to use Bootstrap or FontAwesome, you can still use this plugin by providing your own CSS or using WordPress filters to change the button and icon classes.

**[Check out the demo](#)**

[Built by Boston Dell-Vandenberg](http://pomelodesign.com/) and released under MIT License. If you have questions or put this to use please [find me on Twitter](http://twitter.com/bostondv/) or [report an issue](https://github.com/bostondv/bootstrap-share-buttons-wordpress/issues/)

## Installation

### Composer

`composer require bostondv/bootstrap-share-buttons-wordpress`

### WordPress

_Coming soon to the WordPress.org plugin repository_.

### Non-WordPress projects

[Download the repository](https://github.com/bostondv/bootstrap-share-buttons-wordpress/archive/master.zip) and upload to your project. Include `bootstrap-share-buttons.php` in your project somewhere. 

## Usage

### Shortcode

Display social buttons anywhere shortcodes are supported.

`[bs-share-buttons twitter="bostondv" display="facebook,twitter,google,pinterest" style="both" type="default" size="md"/]`

### Function Call

Display social buttons anywhere within your PHP templates.

`<?php echo bootstrap_share_buttons('bostondv', 'facebook,twitter,google,pinterest', 'both', 'default', 'md'); ?>`

### Parameters

**twitter** _Required_  
Your twitter account handle.

**display** _Default = all_  
Comma separated list of share buttons you wish to display. 
Options: `facebook`, `twitter`, `google`, `pinterest`, `linkedin`, `email`, `print`, or `all`.

**style** _Default = both_  
Style of button to display.  
Options:`icon`, `text`, or `both`.

**type** _Default = default_  
Bootstrap button type.  
Options: `default`, `primary`, `success`, `info`, `warning`, or `danger`.

**size** _Default = md_  
Bootstrap button size.  
Options: `xs`, `sm`, `md`, or `lg`.

### Filters

**bs\_share\_items**  
Allows you to change the share buttons displayed and any of their parameters. Takes two arguments:

`$displayed_items` _(Array)_ - All items that will be displayed.  
`$all_items` _(Array)_ - Array of all available social share buttons.

**bs\_share\_btn\_class**  
Allows you to change the share button classes. Takes two arguments:

`$classes` _(Array)_ - Array of all button classes.  
`$name` _(String)_ - Name of the share button eg. 'facebook'.

**bs\_share\_icon\_class**  
Allows you to change the share button icon classes. Takes two arguments:

`$classes` _(Array)_ - Array of all icon classes.  
`$name` _(String)_ - Name of the share button eg. 'facebook'.

**bs\_share\_text**  
Allows you to change the share button text. Used for the link `title` attribute, and the button text if `style` equals `text` or `both`. Takes two arguments:

`$text` _(String)_ - Text for the button.  
`$name` _(String)_ - Name of the share button eg. 'facebook'.