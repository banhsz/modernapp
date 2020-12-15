<?php 

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class notfound implements Controller
{
    public function build(Request $request): Response
    {
        return new Response('404 Not found');
    }
}