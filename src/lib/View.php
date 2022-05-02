<?php

namespace Ptorres\PhpMvcComposer\lib;

class View
{
    public function render(string $nameView, array $data = [])
    {
        $this->d = $data;
        require 'src/views/' . $nameView . '.php';
    }
}
