<?php
/**
 * Zend framework BarLogger for developer tools
 *
 * @link        https://github.com/renat-magadiev/zf3-bar-logger
 * @copyright   Copyright (c) 2017 Renat MAGADIEV (https://www.magadiev.cz)
 * @license     MIT License https://github.com/renat-magadiev/zf3-bar-logger/blob/master/LICENSE
 */

namespace BarLogger\Collector;

use Tracy\Debugger;
use Tracy\Dumper;
use Zend\Mvc\MvcEvent;
use ZendDeveloperTools\Collector\AbstractCollector;

class DebugCollector extends AbstractCollector
{
    /**
     * @var array
     */
    private static $dump_data = array();

    /**
     * @var int  how many nested levels of array/object properties display by dump()
     */
    public static $maxDepth = 3;

    /**
     * @var int  how long strings display by dump()
     */
    public static $maxLength = 150;

    /**
     * @var bool display location by dump()?
     */
    public static $showLocation = FALSE;

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'bar_logger';
    }

    /**
     * {@inheritDoc}
     */
    public function getPriority()
    {
        return 10;
    }

    /**
     * {@inheritDoc}
     */
    public function collect(MvcEvent $mvcEvent)
    {
        $this->data = self::$dump_data;
    }

    /**
     * @param mixed $var
     * @param string $title
     * @param array|NULL $options
     */
    public static function barDump($var, $title = NULL, array $options = NULL)
    {
        self::$dump_data[] = ['title' => $title, 'dump' => Dumper::toHtml($var, (array)$options + [
                Dumper::DEPTH => self::$maxDepth,
                Dumper::TRUNCATE => self::$maxLength,
                Dumper::LOCATION => Dumper::LOCATION_CLASS,
                Dumper::LIVE => true,
            ])];
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    public function getCss()
    {
        $css = '';
        if (file_exists($this->getAssetsPath() . '/Dumper/dumper.css')) {
            $css .= @file_get_contents($this->getAssetsPath() . '/Dumper/dumper.css');
        }
        if (file_exists($this->getAssetsPath() . '/Toggle/toggle.css')) {
            $css .= @file_get_contents($this->getAssetsPath() . '/Toggle/toggle.css');
        }
        return $css;
    }

    public function getJs()
    {
        $js = '';
        if (file_exists($this->getAssetsPath() . '/Dumper/dumper.js')) {
            $js .= @file_get_contents($this->getAssetsPath() . '/Dumper/dumper.js');
        }
        if (file_exists($this->getAssetsPath() . '/Toggle/toggle.js')) {
            $js .= @file_get_contents($this->getAssetsPath() . '/Toggle/toggle.js');
        }
        return $js;
    }

    /**
     * @return string
     */
    protected function getAssetsPath()
    {
        $reflector = new \ReflectionClass(Debugger::class);
        $fn = $reflector->getFileName();
        return dirname($fn) . '/assets';
    }

}