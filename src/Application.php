<?php 

namespace App;

use App\Controllers\A;
use App\Controllers\B;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Application 
{
    public function run()
    {

        $request = Request::createFromGlobals();
        switch ($request->getPathInfo()) {
            case '/a':
                $controller = new A();
                break;
            case '/b':
                    $controller = new B();
                    break;
            }

        $response = $controller->build($request);
        $response->send();
    }
}