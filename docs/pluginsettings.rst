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
    #. Go to settings->Simple Fields
    #. Import simple-fields-export.json from themes->theopenstandard->imports
    #. Set "Default Post Connector" for Posts to "Simple Fields" - as follows:

.. image:: images/post-type-defaults.png

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

Contact Form 7
-------------

- Enable plugin

- Go to Contact -> Contact Forms
    #. Paste the html below in the Form textarea
    #. Save the form
    #. Copy the provided shortcode into the Contact Us page

    Form HTML

    .. sourcecode:: html

        <p>
        Hello. The Open Standard wants to hear from you. Please, share with us your suggestions.
        Do you have a story tip? A problem with the site? This is where you can reach us.
        </p>

        <p> Name (required)<br />[text* your-name] </p>

        <p>Email (required)<br /> [email* your-email] </p>

        <p>Message<br />[textarea* your-message] </p>

        <p>[submit class:button "Send"]</p>
