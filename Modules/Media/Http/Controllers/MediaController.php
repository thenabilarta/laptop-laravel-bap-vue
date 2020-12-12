<?php

namespace Modules\Media\Http\Controllers;

use Modules\Media\Entities\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Platform\Core\Http\Controllers\AppBaseController;
use CURLFile;

session_start();

class MediaController extends AppBaseController
{
    public function index()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.1.6/xibo-cms/web/api/authorize/access_token',
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

        return view('media::index');
    }

    public function data()
    {
        $media = Media::all();

        return $media;
    }

    public function addmedia(Request $request)
    {
        $file = $request->file('file');

        $file_name = $file->getClientOriginalName();
        $file_ext = $file->getClientOriginalExtension();
        $file_path = $file->getRealPath();

        $fileName = request('fileName');

        $checkIfNameExist = Media::where('name', $fileName)->first();

        if ($checkIfNameExist) {
            return response()->json(["status" => "failed"]);
        }

        $imagePath = $file->storeAs('public/uploads', $file_name);

        $curl_file =  new CURLFile($file_path, $file_ext, $file_name);
        $post_data = array(
            'files' => $curl_file,
            'name' => $fileName
        );

        $target_url = "http://192.168.1.6/xibo-cms/web/api/library";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content_Type: application/json',
            'Authorization: Bearer ' . $_SESSION["token"],
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        $response = curl_exec($ch);
        curl_close($ch);

        $contents = $response;
        $content = json_decode($contents, true);

        $form_data = array(
            'media_id' => '',
            'name' => $fileName,
            'stored_as' => '',
            'file_name' => $file_name,
            'file_path' => $imagePath,
            'retired' => '',
            'size' => '',
            'type' => '',
            'tags' => '',
            'duration' => '',
        );

        if (!isset($content["files"][0]["error"])) {
            $media = Media::create($form_data);

            $medias = $media->getAttributes();

            $mediaId = Media::find($medias["id"]);

            if ($mediaId) {
                $mediaId->media_id = $content["files"][0]["mediaId"];
                $mediaId->retired = $content["files"][0]["retired"];
                $mediaId->stored_as = $content["files"][0]["storedas"];
                $mediaId->size = $content["files"][0]["size"];
                $mediaId->type = $content["files"][0]["type"];
                $mediaId->duration = $content["files"][0]["duration"];
                $mediaId->save();
            }
        }

        return response()->json(["status" => "ok"]);
    }

    // public function edit($id)
    // {
    //     $panel = Panel::where('media_id', $id)->firstOrFail();

    //     return $panel;
    // }

    public function edit(Request $request)
    {
        $newfilename = $request->listName;

        $media_id = $request->media_id;

        $duration = $request->duration;

        // $media_id_real = $request->media_id["media_id"];

        // $media_type = explode('.', $media_id);

        // $media_type_real = $media_type[1];

        $post = 'name=' . $newfilename . '&duration=' . $duration . '&retired=0&tags=0&updateInLayouts=0';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.1.6/xibo-cms/web/api/library/' . $media_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION["token"],
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $contents = $response;
        $content = json_decode($contents, true);

        // $status = $content->getStatusCode();



        if ($content["name"] === $newfilename) {
            $mediaNewName = Media::where('media_id', $media_id)->firstOrFail();

            if ($mediaNewName) {
                $mediaNewName->name = $newfilename;
                $mediaNewName->duration = $duration;
                $mediaNewName->save();
            }
        }

        return response()->json(["status" => "ok"]);
    }

    public function delete($id)
    {
        $media = Media::where('media_id', $id)->firstOrFail();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.1.6/xibo-cms/web/api/library/' . $id,
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

        $media->delete();

        return $content;
    }
}
