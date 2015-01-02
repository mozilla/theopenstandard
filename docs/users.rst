.. This Source Code Form is subject to the terms of the Mozilla Public
.. License, v. 2.0. If a copy of the MPL was not distributed with this
.. file, You can obtain one at http://mozilla.org/MPL/2.0/.

==========
Users
==========

For the purposes of content editing there are 3 user roles we use:

1. Editor - our paid staff, somebody who can publish and manage posts including the posts of other users.
2. Author - folks who have content published on TOS but it's entered/managed by our editors. These users never login.
3. Contributor –  folks who have content published on TOS but it must be reviewed by an editor before being published. These users do login.

Authors
-------
If you have received content from an outside author and need to enter it into wordpress,
this section is for you!

To accomplish the above you must create the user in a unique way. Usually when a user is created an
email is sent with login instructions. Because this user will never login we will use a dummy email address.

Create The Author Account
~~~~~~~~~~~~~~~~~~~~~~~~~
1. In the admin navigate to ``Users`` and click the ``Add New`` button at the top of the page.
2. Under the second section ``Add New User`` fill out the following information:
    1. Username - all lower case concatenate the first and last name ``benjaminsternthal``
    2. Email - use the following email ``TOSEditors+username@mozilla.com`` example TOSEditors+benjaminsternthal@mozilla.com
    3. Role - select ``Author``.
    4. Check this box - ``Add the user without sending an email that requires their confirmation.``
    5. Save - do not upload a profile image from this screen.

.. important::  Wordpress will always send out an email with login information, since these users are not logging in you must always use the email ``TOSEditors+username@mozilla.com``

.. important::  Wordpress will send an email to the editor account. This email should be ignored.

.. note::  Comment moderation emails will be sent to ``TOSEditors+username@mozilla.com`` for their respective articles.

Populate The Author Account
~~~~~~~~~~~~~~~~~~~~~~~~~~~
Once the author account is created you can edit it to add biographical information and a photo.

1. In the admin navigate to ``Users`` ``All Users`` and ``Edit`` the author.
2. Add the following requried information
    1. Image
    2. First Name Last Name
    3. Display Name Publicly As
    4. Biographical Information
3. Add the following optional information
    1. Twitter
    2. Facebook
    3. G+


Contributor
-----------
Documentation coming soon.
