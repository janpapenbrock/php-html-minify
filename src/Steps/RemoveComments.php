<?php

/*
 * This file is part of HtmlOptimization.
 *
 * (c) Jan Papenbrock <mail@janpapenbrock.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace janpapenbrock\HtmlOptimization\Steps;

/**
 * Optimization task to remove HTML comments.
 */
class RemoveComments implements Step
{

    /**
     * Removes all HTML comments from given HTML source.
     *
     * @param string $html
     *
     * @see http://stackoverflow.com/a/5679394/1824988
     *
     * @return string
     */
    public function apply($html)
    {
        $result = preg_replace('/<!--(?!<!)[^\[>].*?-->/s', '', $html);
        return $result;
    }
}
