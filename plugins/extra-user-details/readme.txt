=== Plugin Name ===
Contributors: Vadimk
Donate link: http://vadimk.com/donate/
Tags: plugin, admin, profile, links, social, meta, facebook, twitter, google+, tumblr, linkedin, pinterest, youtube, author, user, users, fields, details.
Requires at least: 3.3
Tested up to: 3.7.1
Stable tag: 0.4.1

Add extra fields to the user profile page, saved in WordPress' native way (in wp_usermeta).

== Description ==

Extra User Details is the simple plugin that allows you to add extra fields to the user profile page (e.g. Facebook, Twitter, LinkedIn links etc).

Extra fields can be easily accessed in your templates like a general wordpress author details:

`<?php the_author_meta('meta_key'); ?>`

Plugin saves fields data in wp_usermeta table. You can add and edit extra fields at plugin options section in backend.

== Installation ==

Install it like any other plugin, no special actions required.

1. Upload `extra_user_details` folder or just `extra_user_details.php` file to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Ready to use. To configure - go to the Users - Extra User Details section

== Frequently Asked Questions ==

= I've found a bug! How do I report? =

Please contact me here http://vadimk.com/contact/.

== Changelog ==

= 0.4.1 =
* Fixed headers already sent issue.

= 0.4 =
+ Added translations for Spanish.

If you're interested in translating plugin into your language, please use contact section.

= 0.3.3 =
* Fixed deprecated functions usage

= 0.3.2 =
* Extra field heading is not shown at user profile edit page if there's no fields to display (user has no access to any configured field).

= 0.3.1 =
* Fixed bug: access level was not saving until the new field was saved.
* Fixed random bug: existing extra fields were not displaying in user profile.
* Fixed some deprecated arguments.

= 0.3 =
* Added access level option to restrict some specific fields usage
* Moved help text to contextual help menu (top right).

= 0.2 =
* Added ability to change meta_key for any field.
* Now order of custom fields can be easily changed by drag and drop.
* Moved plugin options page to Users tab.
* Improved user interface.
* Fixed bug: extra fields disappeared after update.
* Removed default help text.

= 0.1.1 =
* Improved user interface.
* Fixed bug with extra user details retrieval.
* Fixed bug: extra fields values disappeared after update.

= 0.1 =
* Initial release.