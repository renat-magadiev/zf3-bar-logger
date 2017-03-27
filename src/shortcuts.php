<?php

/**
 * @param mixed $var
 * @param string $title
 * @param $options
 */
function barDump($var, $title, $options)
{
    \BarLogger\Collector\DebugCollector::barDump($var, $title, $options);
}