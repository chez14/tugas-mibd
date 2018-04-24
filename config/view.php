<?php
class View {
    protected $registered_variables = [];

    protected function include($viewname, $arrays=[]) {
        if($arrays) {
            $this->registered_variables=array_merge($this->registered_variables, $arrays);
        }
        extract($this->registered_variables, EXTR_OVERWRITE);

        include(realpath(__DIR__ . "/../views" ). "/" . $viewname);
    }

    public static function render($viewname, $arrays = []) {
        return (new View())->include($viewname, $arrays);
    }
}