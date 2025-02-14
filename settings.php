<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Admin settings of the wordcloud plugin
 *
 * @package    mod_wordcloud
 * @copyright  2020 University of Vienna
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$settings->add(new admin_setting_configtext('oerapi_oerhub/requesturl', get_string('requesturlsetting', 'oerapi_oerhub'),
    get_string('requesturlsettingdesc', 'oerapi_oerhub'), '', PARAM_URL));

$settings->add(new admin_setting_configtext('oerapi_oerhub/filtermediatype', get_string('filtermediatypesetting', 'oerapi_oerhub'),
    get_string('filtermediatypesettingdesc', 'oerapi_oerhub'), '', PARAM_TEXT));

$settings->add(new admin_setting_configtextarea('oerapi_oerhub/mediatypeicon', get_string('mediatypeiconsetting', 'oerapi_oerhub'),
    get_string('mediatypeiconsettingdesc', 'oerapi_oerhub'), '', PARAM_RAW));
