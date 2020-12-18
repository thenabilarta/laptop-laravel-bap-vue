<?php

namespace Modules\Schedule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Platform\Core\Http\Controllers\AppBaseController;

session_start();

class ScheduleController extends AppBaseController
{
    public function index()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.44.141/xibo-cms/web/api/authorize/access_token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('client_id' => '3IemY3zoHL2rnNKVop4ccYveukhhlIaXa4ULDF4E', 'client_secret' => 'xGxdY0swNzQlGDPSI2Xv5YXcC2BmeqMTNYUfHeTLzGAMRQ2V3s3WyQ5zl6zWNYjJljbq26dh29EbNnAaKIGfDZ9cVzIvD3SvJOQ07TJq2FWcLl6D4GKcH9ekpP31xZNHxV1CyUEnwTeN2roycfG0B6TmLbPeHbRhnnhz93PJBNJ5EHwRNjuaJqKmeUWpwEywOsnCX1s8a9hYygiL0onuJ3eICd4cfcL1lduleM3gGrhk1XaDZRGp0RCHhI55Rl', 'grant_type' => 'client_credentials')
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $contents = $response;
        $content = json_decode($contents, true);

        $token = $content["access_token"];

        $_SESSION["token"] = $token;

        return view('schedule::index');
    }

    public function data(Request $request)
    {
        $dateFrom = $request->dateFrom;

        $dateTo = $request->dateTo;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.44.141/xibo-cms/web/api/schedule/data/events?displayGroupIds%5B%5D=-1&from=' . $dateFrom . '&to=' . $dateTo,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION["token"],
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $contents = $response;
        $content = json_decode($contents, true);

        return $content;
    }

    public function addSchedule(Request $request)
    {
        $dateFrom = $request->dateFrom;

        $dateTo = $request->dateTo;

        $timeFrom = $request->timeFrom;

        $timeTo = $request->timeTo;

        $eventType = $request->eventType;

        $layout = $request->layout;

        // For each array of Display

        $newString = '';

        $string = '&displayGroupIds%5B%5D=';

        $display = $request->display;

        foreach ($display as $d) {
            $newString = $newString . $string . $d;
        }

        // end of array

        $isPriority = $request->isPriority;

        $displayOrder = $request->displayOrder;

        $syncTimezone = $request->syncTimezone;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.44.141/xibo-cms/web/api/schedule',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>
            'fromDt=' . $dateFrom .
                '%20' . $timeFrom .
                '&toDt=' . $dateTo .
                '%20' . $timeTo .
                $newString .
                '&eventTypeId=' . $eventType .
                '&campaignId=' . $layout .
                '&isPriority=' . $isPriority .
                '&displayOrder=' . $displayOrder .
                '&syncTimezone=' . $syncTimezone,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION["token"],
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $contents = $response;
        $content = json_decode($contents, true);

        return $content;
    }

    public function editSchedule(Request $request)
    {
        $dateFrom = $request->dateFrom;

        $dateTo = $request->dateTo;

        $timeFrom = $request->timeFrom;

        $timeTo = $request->timeTo;

        $eventType = $request->eventType;

        $layout = $request->layout;

        //

        $newString = '';

        $string = '&displayGroupIds%5B%5D=';

        $display = $request->display;

        foreach ($display as $d) {
            $newString = $newString . $string . $d;
        }

        //

        $isPriority = $request->isPriority;

        $displayOrder = $request->displayOrder;

        $syncTimezone = $request->syncTimezone;

        $eventId = $request->id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.44.141/xibo-cms/web/api/schedule/' . $eventId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS =>
            'fromDt=' . $dateFrom .
                '%20' . $timeFrom .
                '&toDt=' . $dateTo .
                '%20' . $timeTo .
                $newString .
                '&eventTypeId=' . $eventType .
                '&campaignId=' . $layout .
                '&isPriority=' . $isPriority .
                '&displayOrder=' . $displayOrder .
                '&syncTimezone=' . $syncTimezone,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION["token"],
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $contents = $response;
        $content = json_decode($contents, true);

        return $content;
    }

    public function delete(Request $request)
    {
        $eventId = $request->id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.44.141/xibo-cms/web/api/schedule/' . $eventId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION["token"],
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $contents = $response;
        $content = json_decode($contents, true);

        return $content;
    }
}
