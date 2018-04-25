<?php
namespace Helper;
class Gravatar {
    public static function get_gravatar($email, $size="50") {
        return "https://www.gravatar.com/avatar/" . md5($email) . "?s=" . $size;
    }
}