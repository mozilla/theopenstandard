.. This Source Code Form is subject to the terms of the Mozilla Public
.. License, v. 2.0. If a copy of the MPL was not distributed with this
.. file, You can obtain one at http://mozilla.org/MPL/2.0/.


==========
Articles
==========

Articles should be easey-peasey to edit in wordpress. Below are the items specific to our theme.

------------


Full & Short Titles
-------------------

There are 2 titles for each article, the full title (used on the article page) and the short title
used everywhere else. If a short title is not supplied the long title will be used.

------------

Deck
----

The ``exerpt`` field is used for the deck and is required.

------------

Categories
----------

Articles should be assigned a single category from the 6 main categories. If an article has more than one of the 6 main categories, you may specify one of them as primary using the Primary Category dropdown below the wysiwyg

------------

Content
-------

The following codes allow you to manipulate the contents of the articles.

Shortcodes
~~~~~~~~~~~

``[post_gallery id="ID HERE"]`` will insert a gallery in the post.

Blockquotes
~~~~~~~~~~~

Blockquote tags will be pulled to the side and have a share button added to them.

``<blockquote>I am some copy</blockquote>`` is Rendered As:

.. image:: images/blockquote-render.png

They will maintain their vertical position within the flow of the document, and the content below them will collapse to fill in the space they occupied.

.. note::  {fill in number of blockquotes allowed and if their position in the copy matters}.


Block Grids
~~~~~~~~~~~
Block grids can be created by putting ```::``` at the beginning of a P tag.
All consequtive p tags that start with ```::``` will be put into the same block grid.

Example:

.. image:: images/block-admin.png

Rendered As:

.. image:: images/block-render.png

------------

Hero Images & Thumbnails
------------------------
Each article "usually" has a hero image. To set this image for an article add it as the
``featured image``. Note this image is used as the thumbnail, insterted into the rss feed and in
other places.

Since the various image sizes are generated upon upload, you should upload a large and high quality
(Max Size 25mb).

Featured Articles
------------------------
Articles that have their visibility set to "Promoted to front page" will go into the row below the hero on the home page
The newest article that have the Category "HP Lead" will be the primary post on the home page


Sponsored Articles
------------------
Sponsored articeles should have the required information entered into the sponsor custom field.

* URL - when clicked where the thumbnail goes.
* Logo - the logo that will appear on the article page. Dimensions should be 124x124


Related Posts
--------------
These show at the bottom of the post with a thumbnail and short title, along with the category of user-defined related posts.

To add posts related to the current one, click the "Add Related Posts" button on the post edit page.

------------


ToDo
--------------------------------------------
- Featured articles, etc
- primary & secondary categories
- tags
- promoting articles to the homepage
- related posts!!

