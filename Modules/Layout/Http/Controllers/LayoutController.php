<?php

namespace Modules\Layout\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Platform\Core\Http\Controllers\AppBaseController;

session_start();

class LayoutController extends AppBaseController
{
    public function index()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.44.127/xibo-cms/web/api/authorize/access_token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('client_id' => 'ZLR24lN2Ztf1HfaPQwKmNy4zVMw8J1F7oc8xRyz6', 'client_secret' => '3opgkjtvFQKaXmDfGbWKC7WWV0778SFgdGf82n6gUbJEdfSbRgyknwF35iDIWDkOgmKNr9y7KrP6UOkoMMGB24zU9MfTTji8ka3dDAorfHYAHfg7eb0mBrbtopcmeK5oRJNjYGKJHbFPw5diPiru8gOFUdkhMjFMbCB6rYBWPIOO41rkvR29uM31i8782O3eVKjQXPfiVA67zEhW7noAvE0KQO3Qr0wwpSg34IHBtlM9FpTZF1C9NQ3phwCz7f', 'grant_type' => 'client_credentials')
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $contents = $response;
        $content = json_decode($contents, true);

        $token = $content["access_token"];

        $_SESSION["token"] = $token;

        return view('layout::index');
    }

    public function data()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.44.127/xibo-cms/web/api/layout',
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

    public function delete(Request $request)
    {
        $layoutId = $request->layoutId;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.44.127/xibo-cms/web/api/layout/' . $layoutId,
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

        return response()->json(["status" => "ok"]);
    }
}