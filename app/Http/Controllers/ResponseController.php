<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(): Response
    {
        return response('Hello Response');

    }

    public function header(Request $request) : Response
    {
        $body = [
            'firstName'=>'Fahmi',
            'lastName'=>'Ilmawan'
        ];
        return response(json_encode($body), 200)
        ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author'=>'Relawan Liwa',
                'App'=>'Ponggawa Liwa'
            ]);
    }

    public function responseView(Request $request): Response
    {
        return view('hello',[
            'name'=>'Fahmi'
        ]);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            'firstName' => 'Fahmi',
            'lastName' => 'Ilmawan'
        ];
        return response()
        ->json($body);
    }
    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/pictures/fahmi.png'));
    }
    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/fahmi.png'));
    }


}
