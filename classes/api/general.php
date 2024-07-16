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

namespace oerapi_oerhub\api;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/filelib.php');

/**
 * Oerhub
 *
 * @package    oerapi_oerhub
 * @copyright  2024 University of Vienna
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class general extends \mod_oercollection\api\general {
    private $baseurl;

    public function __construct($baseurl) {
        $this->baseurl = $baseurl;
    }

    public function get_resource_html($oerresourceid) {
        if (($response = $this->call_repo(null, $oerresourceid)) == '{}') {
            return null;
        }

        $jsondata = json_decode($response, true);

        return $this->create_resource_html($jsondata['data']);
    }

    public function get_search_form() {
        global $PAGE;
        $renderer = $PAGE->get_renderer('core');
        return $renderer->render_from_template('oerapi_oerhub/searchform', ['actionurl' => $this->baseurl]);
    }

    public function get_results($searchstring = null) {
        if (is_null($searchstring)) {
            return null;
        }

        $response = $this->call_repo(json_encode(['query' => $searchstring]));

        $jsondata = json_decode($response, true);
        $results = [];

        foreach($jsondata['data']['hits']['hits'] as $item) {
            $results[] = $this->create_resource_html($item);
        }
        return $results;
    }

    private function create_resource_html($jsondata) {
        global $PAGE;
        $renderer = $PAGE->get_renderer('core');

        $templatecontext = [
            'title' => $jsondata['_source']['oea_title'],
            'abstract' => $jsondata['_source']['oea_abstract'],
            'thumbnail' => $jsondata['_source']['oea_thumbnail_url'],
            'authors' => implode('; ', $jsondata['_source']['oea_authors']),
        ];
        $result = [
            'html' => $renderer->render_from_template('oerapi_oerhub/resource', $templatecontext),
            'id' => $jsondata['_id'],
            'directurl' => $jsondata['_source']['oea_object_direct_link'],
            'title' => $jsondata['_source']['oea_title'],
        ];
        return $result;
    }

    private function call_repo($postdata=null, $resourceid=null) {
        $oerhubconfig = get_config('oerapi_oerhub');
        $serverurl = $oerhubconfig->requesturl;
        $curloptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        ];

        if (!is_null($resourceid)) {
            $serverurl .= $resourceid;
            $curloptions[CURLOPT_CUSTOMREQUEST] = 'GET';
        } else {
            $curloptions[CURLOPT_CUSTOMREQUEST] = 'POST';
            $curloptions[CURLOPT_POSTFIELDS] = $postdata;
            $curloptions[CURLOPT_HTTPHEADER] = ['Content-Type: application/json'];
        }

        $curloptions[CURLOPT_URL] = $serverurl;
        $curl = curl_init();
        curl_setopt_array($curl, $curloptions);
        $response = curl_exec($curl);
        curl_close($curl);


        //$url = 'https://oerhub.at/search/';
        //$postdata = json_encode(['query' => 'Inklusion']);
        /*$postdata = '{
            "query": "Inklusion"
        }';*/
        //$response = download_file_content($url, null, $postdata, true);


        return $response;
    }
}
