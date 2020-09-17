<?php 

use Illuminate\Http\Response;

if(!function_exists('api_success')){
    function api_success($message, $data=null, $code=200){
        $output = [
            'success' => true,
            'message' => $message,
            'data'    => $data ?? null
        ];

        return response()->json($output, $code);
    }
}

if (!function_exists('api_error')) {
    function api_error($message, $data = null, $code = 400, $errCode = null)
    {
        $rest   = [
            "version"   => config("api.version"),
            "error" => [
                "code"       => $code,
                "message"    => $message,
            ]
        ];

        if ($errCode)
            $rest['error']['code'] = $errCode;

        if ($data) $rest['error']['errors'] = $data;

        return response()->json($rest, $code);
    }
}