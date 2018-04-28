<?php
Namespace Helper;
class Ajaxify {
    public static function boot() {
        header("Content-type: application/json");
        // do CORS here.
    }

    public static function serve($data = []) {
        echo json_encode($data, isset($_GET['prettyprint'])?JSON_PRETTY_PRINT:0);
        return ;
    }
}