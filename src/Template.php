<?php  

namespace App;

class Template 
{
    private $template_dir;

    public function __construct()
    {
        $this->template_dir = __DIR__ . '/../templates/';
    }

    public function render($template, $variables)
    {
        ob_start();
        extract($variables);
        include($this->template_dir . $template . '.php');
        return ob_get_clean();
    }
}