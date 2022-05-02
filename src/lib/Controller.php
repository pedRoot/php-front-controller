<?php

namespace Ptorres\PhpMvcComposer\lib;

use Ptorres\PhpMvcComposer\lib\View;

class Controller
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function render(string $nameView, array $data = [])
    {
        $this->view->render($nameView, $data);
    }

    protected function post(string $param)
    {
        return isset($_POST[$param]) ? $_POST[$param] : null;
    }

    protected function get(string $param)
    {
        return isset($_GET[$param]) ? $_GET[$param] : null;
    }

    protected function file(string $param)
    {
        return isset($_FILES[$param]) ? $_FILES[$param] : null;
    }
}
