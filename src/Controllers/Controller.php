<?php 

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface Controller 
{
    public function build(Request $request) : Response;
}