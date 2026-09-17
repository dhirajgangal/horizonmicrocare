<?php

namespace App\Support;

class Toast
{
    /**
     * @param  'success'|'danger'  $type
     */
    public static function flash(string $message, string $type = 'success'): void
    {
        session()->flash('toast', [
            'type' => $type,
            'message' => $message,
        ]);
    }

    public static function success(string $message): void
    {
        self::flash($message, 'success');
    }

    public static function error(string $message): void
    {
        self::flash($message, 'danger');
    }
}
