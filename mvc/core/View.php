<?php

namespace sebastiangolian\php\mvc\core;

/**
 * View
 *
 * PHP version 7.0
 */
class View
{

    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/view/".$view.".php";  // relative to Core directory

        if (is_readable($file)) {
            require dirname(__DIR__) . "/view/header.php";
            require $file;
            require dirname(__DIR__) . "/view/footer.php";
        } else {
            throw new \Exception("$file not found");
        }
    }
}
