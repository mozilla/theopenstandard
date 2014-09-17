.. This Source Code Form is subject to the terms of the Mozilla Public
.. License, v. 2.0. If a copy of the MPL was not distributed with this
.. file, You can obtain one at http://mozilla.org/MPL/2.0/.

.. _pluginsettings:

===============
Plugin Settings
===============

Simple Fields
-------------
- Create a field group called "Gallery"
    #. Check "Repeatable" and "Use table view"
    #. Add field called "Image" of type "File" and check "Enable extended return values"
    #. Add field called "Video Embed Url" of type "Text" and sub-type "text"

- Create a post connector called "Post Gallery"
    #. Add the "Gallery" field group you just created
    #. Check "Posts (post)" under "Available for post types"
