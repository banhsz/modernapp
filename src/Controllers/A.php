<?php 

namespace App\Controllers;

use App\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class A implements Controller, WithTemplate
{
    private $template;

    public function build(Request $request): Response
    {
        $content = $this->template->render('index', ['name' => '<Karcsi>']);
        return new Response($content);
    }

    public function setTemplate(Template $template)
    {
        $this->template = $template;
    }

}