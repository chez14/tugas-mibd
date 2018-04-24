<?php
class View {
    protected function include($viewname, $arrays) {
        extract($arrays, EXTR_OVERWRITE);
        include($viewname);
    }

    public static function render($viewname, $arrays = []) {
        return (new View())->include($viewname, $arrays);
    }
}