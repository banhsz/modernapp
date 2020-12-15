<?php 

namespace App\Controllers;

use App\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class C implements Controller, WithTemplate
{
    private $template;

    public function build(Request $request): Response
    {
        $array = array(
            "name"  => "karcsi",
            "gender" => "male",
            "age" => 15,
            "hobbies" => "football",
        );
        $content = $this->template->render('array', $array);
        return new Response($content);
    }

    public function setTemplate(Template $template)
    {
        $this->template = $template;
    }

}