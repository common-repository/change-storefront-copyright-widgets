=== Change Copyright for Storefront using Widgets - Change Storefront copyright text with menus, logos, html, etc. ===
Contributors: wpcentrics
Donate link: http://www.wp-centrics.com/
Tags: footer, credit, copyright, customizer, storefront
Requires at least: 4.4.0
Tested up to: 5.8
Stable tag: 1.0.3
Requires PHP: 5.5
WC requires at least: 2.6
WC tested up to: 5.5
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Replace the footer credit text for WooCommerce Storefront theme easily from customizer through widgets! Put anything you need!

== Description ==

This plugin lets you easily edit the footer credit text for Storefront theme from customizer. No need for any code.

The original copyright text will be replaced by one or two widgetitzed areas, then you can put on it any widget: image, text, menu, etc.


This plugin will work only on [Storefront theme](https://wordpress.org/themes/storefront) WooCommerce theme.

**Features:**

* Replace the Storefront copyright text by one (fullwidth) or two (two columns) sidebars (widgetitzed areas)
* Place on the new footer sidebar(s) everything what you want, through widgets: logo, menus, text, html, etc.
* Choose text align on every area: centered, left, right
* Manage widgets nicely through customizer in the wordpress way, as any other sidebar
* Format the menus in copyright in one line, or keep it in the standard sidebar menu look and feel.
* You still can use the upper footer sidebars that come with Storefront, this plugin REPLACE the copyright with new one(s).


**How to use:**

1. Navigate to Customizer page under Appearance.
2. Find the Footer Section.
3. Under the Footer section, scroll down and you will find the alignment and menu style preferences.
4. Switch to the Widgets Section.
5. You will find a two new ones: Copyright Content Left and Copyright Content Right
6. Place on it the content as you need, by adding widgets
7. Leave the right content empty to make the left fullwidth (you will see the difference if you choose centered align)

== Installation ==

**Install via the WordPress Dashboard:**

1. Login to your WordPress Dashboard.
2. Navigate to Plugins, and select add new to go to the "Add Plugins" page.
3. In the right side, enter "Change Copyright for Storefront" in the search input bar, and hit your enter key.
4. Click install, and wait for the plugin to download. Once done, activate the plugin.

**Install via FTP:**

1. Extract the zip file, login using your ftp client, and upload the storefront-site-logo folder to your `/wp-content/plugins/` directory
2. Login to your WordPress Dashboard.
3. go to plugins and activate "Change Copyright for Storefront using Widgets" plugin.


== Frequently Asked Questions ==

**Will this plugin work for themes other than Storefront?**
Unfortunately, No. This plugin was designed to work for the Storefront theme, utilizing Storefront's action hooks and filters. Activating the plugin while using a different theme will not produce any change or bug. 

**Can I use this plugin with another Storefront Child Theme**
You're free to try it. If you do, please, write us through repository support forum, but please, don't write a bad review if it not works with another theme!

**I've activated the plugin, where can I access the settings?**
The settings for this plugin can be found in the Customizer page under Appearance. In that page, find the section named "Footer". You can use also the older Apparence > Widgets to manage the content, but not the alignment options.

== Screenshots ==

1. Here's an animation of how it works.
2. The Storefront copyright before plugin activation.
3. The Storefront copyright replaced by two empty areas.
4. Puting content through widgets on left area (fullwidth if right is empty)

== Upgrade Notice ==

* No bugs found ;)

== Changelog ==

= 1.0.3 - 2021-07-19 =
* Checked for WordPress 5.8 and WooCommerce 5.5
* Text-domain changed to the same as plugin slug: change-storefront-copyright-widgets

= 1.0.2 - 2021-03-17 =
* Checked for latest compatibility: WordPress 5.7 + WooCommerce 5.1

= 1.0.1 - 2020-12-29 =
* Helpers added for alignment on RTL languages

= 1.0.0 - 2020-09-14 =
* Hello, world!
