OER-API - OERhub
===================

This file is part of the oerapi_oerhub plugin for Moodle - <http://moodle.org/>

*Author:* Angela Baier, Adrian Czermak

*Copyright:* 2024 [University of Vienna](https://www.univie.ac.at/)

*License:* [GNU GPL v3 or later](http://www.gnu.org/copyleft/gpl.html)

Description
-----------
With the subplugin "OER-API - OERhub" teachers are able to search for available Open Educational Resources (OER) from the [OERhub](https://oerhub.at) via the resource "OER Collection" (https://github.com/elearning-univie/moodle-mod_oercollection).

Usage
-----------
Teachers want to search for published Open Educational Resources (OER) via [OERhub](https://oerhub.at) to use them in their own lecture. This subplugin executes the search requests at the OERhub and provides results which can be filtered by discipline, media type, language and published from/ to date.

Admins can define which media types are included in the results and how they should be displayed.

Requirements
-----------
The plugin is available for Moodle 4.4+.

* The module "OER Collection" (https://github.com/elearning-univie/moodle-mod_oercollection) must be installed to run this plugin.
* The admin setting *requesturl* has to be set to "https://oerhub.at/search/", the URL of the OERhub server.
* Via the optional admin setting *filtermediatype* displayed media types can be restricted by entering a comma-separated list of file extensions (e.g.: mp4,pdf). Details can be found at the admin settings description.
* Via the optional admin setting *mediatypeicon* icons for every displayed media type can be defined as a key/value pair in JSON style, where key is the mediatype in oerhub and value is the moodle icon. e.g. {"pdf":"f/pdf"}. If the field is left empty, OER will be displayed without an icon.(Setting is under development and further details will be published soon.)

Installation
-----------
* Copy the code directly to the mod/oercollection directory.
* Log into Moodle as administrator.
* Open the administration area (http://your-moodle-site/admin) to start the installation automatically.

Privacy API
-----------
The plugin fully implements the Moodle Privacy API.

Documentation
-----------
You can find further information to the plugin "OER Collection" on the [Wiki of the University of Vienna](https://wiki.univie.ac.at/x/to2WHg).

Bug Reports / Support
-----------
We try our best to deliver bug-free plugins, but we cannot test the plugin for every platform,
database, PHP and Moodle version. If you find any bug please report it on
[GitHub](https://github.com/academic-moodle-cooperation/moodle-oerapi_oerhub/issues). Please
provide a detailed bug description, including the plugin and Moodle version and, if applicable, a
screenshot.

You may also file a request for enhancement on GitHub. If we consider the request generally useful
and if it can be implemented with reasonable effort we might implement it in a future version.

You may also post general questions on the plugin on GitHub, but note that we do not have the
resources to provide detailed support.

License
-----------
This plugin is free software: you can redistribute it and/or modify it under the terms of the GNU
General Public License as published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

The plugin is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
General Public License for more details.

You should have received a copy of the GNU General Public License with Moodle. If not, see
<http://www.gnu.org/licenses/>.


Good luck and have fun!