=== Google Maps Store Locator for WordPress ===
Contributors: moaluko
Donate link: http://www.viadat.com/donate
Tags: store locator, location finder, google maps, places, stores, maps, mapping, mapper, coordinates, latitude, longitude, geo, geocoding, shops, ecommerce, e-commerce, business locations
Requires at least: 2.3.3
Tested up to: 2.7.1
Stable tag: 1.2.23

A store locator plugin for developers who create sites in Wordpress & web site owners who want to quickly show important locations.

== Description ==

A store locator / location finder plugin focused on providing mapping tools for web designers & developers
who create sites in Wordpress & web site owners needing to show important stores or any other type of 
location.

== Installation ==

= MAIN PLUGIN =

1. Upload the `store-locator` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place the code '[STORE-LOCATOR]' (case-sensitive) in the body of a page or a post to display your store locator

= ADD-ONS =

1. Unzip & Upload the entire add-on folder to the `/wp-content/plugins/store-locator/addons` directory.
2. Activate the add-on by updating the Activation Key that you receive after purchase at the bottom of the "News & Upgrades" Page.

= THEMES =

1. Unzip & Upload the entire theme folder to the `/wp-content/plugins/store-locator/themes` directory. Themes will show up under the "Map Designer" Tab.

= ICONS =
1. There are some default icons in the `/wp-content/plugins/store-locator/icons` directory. Add your own custom icons in this directory to display them on the map.

== Frequently Asked Questions ==

= Do I need a Google Account to use this store locator? =

Yes, you will need a Google account in order to retrieve an API for your maps to work properly

1. To sign up for a Google Account, visit: https://www.google.com/accounts/
2. To sign up for a Google Maps API Key, visit: http://code.google.com/apis/maps/signup.html

= How Do I use a Translation? =

1. Place .po & .mo translation files into the `/wp-content/plugins/store-locator/languages` folder, and then change the `WPLANG` constant to the corresponding language abbreviation in the `wp-config.php` file in the root wordpress directory
2. Example: to use French, make sure `lol-fr_FR.po` & `lol-fr_FR.mo` are in the `languages` folder, then change make sure update the code in `wp-config.php` to read `define('WPLANG', 'fr_FR')`, and Voila, Il sera en francais (It will be in French).

= Which countries is this compatible with? =

This plugin is compatible with all countries that have Google Map domains. This includes:

* Austria
* Australia
* Bosnia and Herzegovina
* Belgium
* Brazil
* Canada
* Switzerland
* Czech Republic
* Germany
* Denmark
* Spain
* Finland
* France
* Italy
* Japan
* Netherlands
* Norway
* New Zealand
* Poland
* Russia
* Sweden
* Taiwan
* United Kingdom
* United States