<?php

namespace App\Http\Controllers;

use App\Service\HalloService;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\PHP;

class HelloController extends Controller
{
    private HalloService $halloService;
    public function __construct(HalloService $halloService)
    {
        $this->halloService = $halloService;
    }


    public function hello(Request $request, $name) : string
    {
        return $this->halloService->hello($name);
    }

    public function request(Request $request) : string
    {
        return $request->path(). PHP_EOL.
            $request->url(). PHP_EOL.
            $request->fullUrl(). PHP_EOL.
            $request->method(). PHP_EOL.
            $request->header('Accept');

    }

}
