<?php   

namespace App;

interface Template  
{
    public function render($template, $variables);
}