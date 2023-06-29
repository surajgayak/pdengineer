<?php

namespace App\Helper;

class Toastr
{
    public static function success(string $msg)
    {
        session()->push('toastr-success', $msg);
    }
    public static function info(string $msg)
    {
        session()->push('toastr-info', $msg);
    }

    public static function warning(string $msg)
    {
        session()->push('toastr-warning', $msg);
    }

    public static function error(string $msg)
    {
        session()->push('toastr-error', $msg);
    }
}
