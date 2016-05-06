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
 * Interface for optimization tasks.
 */
interface Step
{

    /**
     * Optimizes given HTML and returns optimized HTML.
     *
     * @param string $html
     *
     * @return string
     */
    public function apply($html);
}
