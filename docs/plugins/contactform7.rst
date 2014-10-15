.. This Source Code Form is subject to the terms of the Mozilla Public
.. License, v. 2.0. If a copy of the MPL was not distributed with this
.. file, You can obtain one at http://mozilla.org/MPL/2.0/.


==============
Contact Form 7
==============

Provides the contact us form. Note we use Akismet to cut down on spam with this form.

- Enable plugin

- Go to Contact -> Contact Forms
    #. Paste the html below in the Form textarea
    #. Save the form
    #. Copy the provided shortcode into the Contact Us page

    Form HTML

    .. sourcecode:: html

        <p>
        Hello. The Open Standard wants to hear from you. Please, share with us your suggestions. Do you have a story tip? A problem with the site? This is where you can reach us.
        </p>
        
        <p> Name<br />[text your-name akismet:author] </p>
        
        <p>Email (required)<br /> [email* your-email akismet:author_email] </p>
        
        <p>Message<br />[textarea* your-message] </p>
        
        <p>[submit class:button "Send"]</p>

