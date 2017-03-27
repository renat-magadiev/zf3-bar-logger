<?php

/**
 * @param mixed $var
 * @param string $title
 * @param $options
 */
function barDump($var, $title = NULL, array $options = NULL)
{
    \BarLogger\Collector\DebugCollector::barDump($var, $title, $options);
}