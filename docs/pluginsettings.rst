.. This Source Code Form is subject to the terms of the Mozilla Public
.. License, v. 2.0. If a copy of the MPL was not distributed with this
.. file, You can obtain one at http://mozilla.org/MPL/2.0/.

.. _pluginsettings:

===============
Plugin Settings
===============

Simple Fields
-------------

- Enable plugin
- Create a field group called "Gallery"
    #. Check "Repeatable" and "Use table view"
    #. Add field called "Image" of type "File" and check "Enable extended return values"
    #. Add field called "Video Embed Url" of type "Text" and sub-type "text"
- Create a post connector called "Post Gallery"
    #. Add the "Gallery" field group you just created
    #. Check "Posts (post)" under "Available for post types"
-  Create a post connector called "Gallery Fields"
    #. Add the "Gallery" field group
    #. Check "Galleries (gallery)" under "Available for post types"

- Set "Gallery Fields" as a default post connector for Galleries

Featured Images in RSS w/ Size and Position
-------------------------------------------

This plugin inserts the featured image for a post into the RSS feed. Note these
feeds are used by the mozilla.org homepage.

The plugin uses the "story-rss" image size specified in the functions.php file. This image size
is 460px wide with no restriction on height.

- Enable plugin
- Go to Settings -> Featured Images In Rss Feeds
	#. Select "story-rss"
	#. Select "Image Centered Above Text"


Password Protected
------------------

This plugin password protects all pages on the blog and is only used during
the initial population of the production site.

We do not password protect the RSS feed.

- Enable plugin
- Go to Settings -> Password Protected
    #. Enable "Password Protected Status"
    #. Protected Permissions Enable "Allow Administrators"
    #. Enter A Password

Related Posts
-------------

- Enable plugin (Automatically link if you feel like it.)

- Go to Settings -> Related Posts
    #. Uncheck “Enable”
    #. Erase contents of “Heading Text”
    #. Erase contents of “CSS”
