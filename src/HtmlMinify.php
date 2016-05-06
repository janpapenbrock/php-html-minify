<?php

/*
 * This file is part of HtmlMinify.
 *
 * (c) Jan Papenbrock <mail@janpapenbrock.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace janpapenbrock\HtmlMinify;

use janpapenbrock\HtmlMinify\Steps\Step;

/**
 * HTML optimization and minification.
 *
 * Will reduce your HTML of all that funky noise that makes it human readable, but so big and slow.
 *
 * Usage:
 *   $minify = new janpapenbrock\HtmlMinify\HtmlMinify();
 *   $minHtml = $minify->minify($html);
 */
class HtmlMinify
{

    /**
     * Minify given HTML.
     *
     * @param string $html
     *
     * @return string
     */
    public function minify($html)
    {
        $result = $html;

        foreach ($this->getSteps() as $step) {
            $result = $step->apply($result);
        }

        return $result;
    }

    /**
     * Get all optimization steps.
     *
     * @return Step[]
     */
    public function getSteps()
    {
        $result = array();

        foreach ($this->getStepNames() as $modelName) {
            $instance = $this->getStepInstance($modelName);

            if ($instance) {
                $result[$modelName] = $instance;
            }
        }

        return $result;
    }

    /**
     * Get optimizer instance for given optimizer name.
     *
     * @param string $name
     *
     * @return Step
     */
    protected function getStepInstance($name)
    {
        $result = null;

        $className = sprintf('janpapenbrock\HtmlMinify\Steps\%s', $name);
        if (class_exists($className)) {
            $result = new $className();
        }

        return $result;
    }

    /**
     * Get optimizer model name from given file name.
     *
     * @param string $fileName
     *
     * @return string
     */
    protected function getStepModelNames($fileName)
    {
        if (strpos($fileName, '.php') === false) {
            return false;
        }

        $result = $fileName;
        $result = rtrim($result, '.php');

        return $result;
    }

    /**
     * Get all optimizer model names.
     *
     * @return array
     */
    protected function getStepNames()
    {
        $result = array();

        $files = scandir(__DIR__ . '/Steps');
        foreach ($files as $file) {
            $result[] = $this->getStepModelNames($file);
        }

        $result = array_filter($result);

        return $result;
    }
}
