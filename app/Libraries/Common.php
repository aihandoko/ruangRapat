<?php

namespace App\Libraries;

class Common
{
    public function base64urlEncode(string $text): string
    {
        return str_replace(
            ["+", "/", "="],
            ["-", "_", ""],
            base64_encode($text)
        );
    }

    public function base64urlDecode(string $text): string
    {
        return base64_decode(str_replace(
            ["-", "_"],
            ["+", "/"],
            $text)
        );
    }

    public function dateConverter($date, $dateOnly = false)
    {
        $day = substr($date, 8, 2);
        $month = substr($date, 5, 2);
        $year = substr($date, 2, 2);
        $yearfull = substr($date, 2, 4);
        $hour = substr($date, 11, 2);
        $min = substr($date, 14, 2);

        if($dateOnly) {
            return $day . '-' . $month . '-' . $year;
        }

        return $day . '/' . $month . '/' . $year . ' ' . $hour . ':' . $min;
    }
}