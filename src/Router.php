<?php 

namespace App;

use App\Controllers\A;
use App\Controllers\B;
use App\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class Router 
{
    protected $request;

    public function __construct(Request $request)
    {
       $this->request = $request; 
    }

    public function getController() : Controller
    {
        switch ($this->request->getPathInfo()) {
            case '/a':
                $controller = new A();
                break;
            case '/b':
                    $controller = new B();
                    break;
            }
        return $controller;
    }
}