<?php

/*
 * This file is part of HtmlMinify.
 *
 * (c) Jan Papenbrock <mail@janpapenbrock.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace janpapenbrock\HtmlMinify\Steps;

/**
 * Optimization task to remove whitespaces.
 */
class RemoveWhitespaces implements Step
{

    /**
     * Optimizes whitespaces in given HTML source.
     *
     * @param string $html
     *
     * @return string
     */
    public function apply($html)
    {
        $result = $html;

        $result = $this->replaceTabs($result);
        $result = $this->mergeSpaces($result);

        return $result;
    }

    /**
     * Replace tab stops in given HTML by spaces.
     *
     * @param string $html
     *
     * @return string
     */
    protected function replaceTabs($html)
    {
        $result = str_replace("\t", " ", $html);
        return $result;
    }

    /**
     * Replace multiple spaces in given HTML by single space.
     *
     * @param string $html
     *
     * @return string
     */
    protected function mergeSpaces($html)
    {
        $result = preg_replace('/[ ]{2,}/u', " ", $html);
        return $result;
    }
}
