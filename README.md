The Open Standard
=================

The Open Standard Website https://wiki.mozilla.org/Websites/The_Open_Standard



Building Documentation Locally
------------------------------
The instructions below assume you have Python and
[pip](https://pip.pypa.io/) installed. It is also
strongly recommended that you create and activate a
[virtualenv](https://virtualenv.pypa.io/) first.

If you'd like to build the documentation locally:

```sh
   cd docs
   pip install -r requirements.txt
   make html
```

The resulting docs can be located under the ``_build/html`` directory.

You can also run ``make livehtml`` to launch a webserver on
http://127.0.0.1:8000 that auto-rebuild the documentation when any files are
changed.
