=== Google Maps Store Locator for WordPress ===
Contributors: moaluko
Donate link: http://www.viadat.com/donate
Tags: store locator, location finder, google maps, places, stores, maps, mapping, mapper, coordinates, latitude, longitude, geo, geocoding, shops, ecommerce, e-commerce, business locations
Requires at least: 2.3.3
Tested up to: 2.8.1
Stable tag: 1.2.28.2

A store locator plugin for developers who create sites in Wordpress & web site owners who want to quickly show important locations.

== Description ==

A store locator / location finder plugin focused on providing mapping tools for web designers & developers
who create sites in Wordpress & web site owners needing to show important stores or any other type of 
location.

== Installation ==

= MAIN PLUGIN =

1. Upload the `store-locator` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Sign up for a Google Maps API Key for your domain at http://code.google.com/apis/maps/signup.html
4. Add your locations through the 'Add Locations' page in the Store Locator admin panel
5. Place the code '[STORE-LOCATOR]' (case-sensitive) in the body of a page or a post to display your store locator

= ADD-ONS =

1. Unzip & Upload the entire add-on folder to the `/wp-content/plugins/store-locator/addons` directory.
2. Activate the add-on by updating the Activation Key that you receive after purchase at the bottom of the "News & Upgrades" Page.

= THEMES =

1. Unzip & Upload the entire theme folder to the `/wp-content/plugins/store-locator/themes` directory. Themes will show up under the "Map Designer" Tab.

= ICONS =
1. There are some default icons in the `/wp-content/plugins/store-locator/icons` directory. Add your own custom icons in this directory to display them on the map.

== Changelog ==
= 1.2.28.2 =
* Incorporated fix for "Warning: Cannot modify header information – headers already sent ..." error occuring for those that have updated to WordPress Version 2.8.1.  Fix provided by forum user 'mikeycnp' here: http://rosile.com/2009/07/wp-store-locator-fix/ --- thank you mikeyncp.  Users, please make sure to leave thank you comment on http://rosile.com .
= 1.2.28.1 =
* Fixed "You do not have sufficient permissions to access this page." issue occuring for those that have updated to WordPress Version 2.8.1
* Added this Changelog

== Frequently Asked Questions ==

Make sure to check http://docs.viadat.com for the most updated information

= Do I need a Google Account to use this store locator? =

Yes, you will need a Google account in order to retrieve an API for your maps to work properly

1. To sign up for a Google Account, visit: https://www.google.com/accounts/
2. To sign up for a Google Maps API Key, visit: http://code.google.com/apis/maps/signup.html

= How Do I use a Translation? =

1. Place .po & .mo translation files into the `/wp-content/plugins/store-locator/languages` folder, and then change the `WPLANG` constant to the corresponding language abbreviation in the `wp-config.php` file in the root wordpress directory
2. Example: to use French, make sure `lol-fr_FR.po` & `lol-fr_FR.mo` are in the `languages` folder, then make sure to update the code in `wp-config.php` to read `define('WPLANG', 'fr_FR')`, and Voila, Il sera en francais (It will be in French).

= Which countries is this compatible with? =

This plugin is compatible with all countries that have Google Map domains. This includes:

* Austria (updated as of v1.2.28)
* Australia
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
* Japan (updated as of v1.2.28)
* Netherlands
* Norway
* New Zealand
* Poland
* Russia
* Sweden
* Taiwan (updated as of v1.2.28)
* United Kingdom
* United States

Added (as of v1.2.28):

* China
* India
* Hong Kong
* Kenya
* Liechtenstein
* Malaysia
* South Korea
* Thailand

Removed (as of v.1.2.28):

* Bosnia and Herzegovina (doesn't appear to be working anymore)