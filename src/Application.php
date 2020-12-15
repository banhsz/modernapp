<?php 

namespace App;

use App\Controllers\WithTemplate;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Application 
{
    public function run()
    {

        $request = Request::createFromGlobals();
        $router = new Router($request);
        $controller = $router->getController();
        if (in_array(WithTemplate::class, class_implements($controller))) {
            $template = new TwigTemplate;
            /** @var WithTemplate */
            $controller->setTemplate($template);
        }
        $response = $controller->build($request);
        $response->send();
    }
}