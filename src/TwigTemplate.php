<?php  

namespace App;

class TwigTemplate implements Template
{
    private $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../twig_templates');
        $this->twig = new \Twig\Environment($loader);
    }
    public function render($template, $variables)
    {
        return $this->twig->render($template . '.html.twig', $variables);
    }
}