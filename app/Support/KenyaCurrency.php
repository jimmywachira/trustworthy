<?php

namespace App\Support;

class KenyaCurrency
{
    /**
     * Format a numeric value as Kenyan shillings.
     */
    public static function format(float|int|string|null $amount, int $decimals = 0): string
    {
        if ($amount === null || $amount === '') {
            return 'KSh 0';
        }

        return 'KSh '.number_format((float) $amount, $decimals);
    }
}
