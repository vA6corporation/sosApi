<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/', function (Request $request) {
    $url = "https://e-factura.sunat.gob.pe/ol-it-wsconscpegem/billConsultService"; 
    $soap = view('soapCdr', $request->toArray());
    $response = Http::send('POST', $url, [
        'body' => $soap,
    ]);
    $dom = new DomDocument();
    $dom->loadXML($response->body());
    try {
        $cdr = $dom->getElementsByTagName('content')[0]->nodeValue;
        $statusCode = $dom->getElementsByTagName('statusCode')[0]->nodeValue;
        $statusMessage = $dom->getElementsByTagName('statusMessage')[0]->nodeValue;
        return [
            'cdr' => $cdr,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
        ];
    } catch (\Throwable $th) {
        $statusCode = $dom->getElementsByTagName('statusCode')[0]->nodeValue;
        $statusMessage = $dom->getElementsByTagName('statusMessage')[0]->nodeValue;
        return [
            // 'cdr' => $cdr,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
        ];
    }
});
