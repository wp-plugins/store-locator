=== Plugin Name ===
Contributors: moaluko
Donate link: http://www.viadat.com/donate
Tags: store locator, location finder, wordpress store locator plugin, google maps, ecommerce, e-commerce, business locations, lots of locales
Requires at least: 2.3.3
Tested up to: 2.7
Stable tag: 1.0

A locator plugin for developers who create sites in Wordpress & web site owners who want to quickly show important locations.

== Description ==

This is Lots of Locales (LoL) - A Store Locator / Location Finder plugin focused on providing robust mapping tools for Web Designers & Developers who create sites in Wordpress & web site owners needing to show important stores or any other type of location. There are three phases to the plugin:

PHASE 1:
LoL Store Locator Plugin for Wordpress is released.

PHASE 2:
LoL Store Locator Marketplace opens, once at least 50,000 people have downloaded the LoL Store Locator Plugin.
Anyone with the plugin has opportunity to monetize their plugins --- details revealed at launch. (May potentially depend on developments with the Google API)

PHASE 3:
The GlenVille Project (???) --- stay tuned as this story unfolds --- in the meantime, enjoy!

== Installation ==

MAIN PLUGIN
1. Upload the `store-locator` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place the code '[STORE-LOCATOR]' (case-sensitive) in the body of a page or a post to display your store locator

ADD-ONS
1. Unzip & Upload the entire add-on folder to the `/wp-content/plugins/store-locator/addons` directory.
2. Activate the add-on by updating the License Key that you receive after purchase at the bottom of the "News & Upgrades" Page.

THEMES
1. Unzip & Upload the entire theme folder to the `/wp-content/plugins/store-locator/themes` directory. Themes will show up under the "Map Designer" Tab.

ICONS
1. There are some default icons in the `/wp-content/plugins/store-locator/icons` directory. Add your own custom icons in this directory to display them on the map.

== Frequently Asked Questions ==

= What are these "phases" that you're talking about? =
Instead of just "versions", we've planned out a 3-phased approached to this plugin.  But even more, we've identified a potential financial benefit to people who decide to make full use of this plugin --- starting at Phase 2.

= Do I need a Google Account to use this store locator? =
Yes, you will need a Google account in order to retrieve an API for your maps to work properly
1. To sign up for a Google Account, visit: https://www.google.com/accounts/
2. To sign up for a Google Maps API Key, visit: http://code.google.com/apis/maps/signup.html

= How Do I use a Translation? =
1. Place .po & .mo translation files into the `/wp-content/plugins/store-locator/languages` folder, and then change the `WPLANG` constant to the corresponding language abbreviation in the `wp-config.php` file in the root wordpress directory
2. Example: to use French, make sure `lol-fr_FR.po` & `lol-fr_FR.mo` are in the `languages` folder, then change make sure update the code in `wp-config.php` to read `define('WPLANG', 'fr_FR')`, and Voila, Il sera en français (It will be in French).

= Which countries can I use this plugin for? =
This plugin is compatible with all countries that current Google Map domains, which includes:
Austria, Australia, Bosnia and Herzegovina, Belgium, Brazil, Canada, Switzerland,
Germany, Denmark, Spain, Finland, France, Japan, Netherlands, Norway, New Zealand, Poland,
Russia, Sweden, Taiwan, United Kingdom, and United States
