<?php


class DateKeysProcessor
{

    public function daysToStringMonthKey($days)
    {
        return round($days/30);
    }

}