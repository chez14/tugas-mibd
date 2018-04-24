<?php
class View {
    protected function include($viewname, $arrays=[]) {
        extract($arrays, EXTR_OVERWRITE);
        include(__DIR__ . "/" . $viewname);
    }

    public static function render($viewname, $arrays = []) {
        return (new View())->include($viewname, $arrays);
    }
}