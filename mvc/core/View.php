<?php

namespace sebastiangolian\php\mvc\core;

class View
{

    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/view/".$view.".php";  // relative to Core directory

        if (is_readable($file)) {
            require dirname(__DIR__) . "/view/layout/header.php";
            require $file;
            require dirname(__DIR__) . "/view/layout/footer.php";
        } else {
            throw new \Exception("$file not found");
        }
    }
}
