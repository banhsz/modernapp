<?php  

namespace App\Controllers;

use App\Template;

interface WithTemplate
{
    public function setTemplate(Template $template);
}