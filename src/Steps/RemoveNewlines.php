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
 * Optimization task to remove HTML comments.
 */
class RemoveNewlines implements Step
{
    const COMMENT_MARKER = '/** NEWLINE */';

    /**
     * Removes all HTML newlines from given HTML source.
     *
     * @param string $html
     *
     * @return string
     */
    public function apply($html)
    {
        $result = $html;

        $result = $this->insertCommentMarker($result);
        $result = $this->removeNewlines($result);
        $result = $this->replaceCommentMarkerWithNewline($result);

        return $result;
    }

    /**
     * Remove newlines from given HTML.
     *
     * @param string $html
     *
     * @return string
     */
    protected function removeNewlines($html)
    {
        $result = str_replace(
            array("\r\n", "\r", "\n"),
            " ",
            $html
        );
        return $result;
    }

    /**
     * Insert marker after javascript comment in given HTML.
     *
     * @param string $html
     *
     * @return string
     */
    protected function insertCommentMarker($html)
    {
        $result = preg_replace(
            '/\s+\/\/.*/',
            '$0' . static::COMMENT_MARKER,
            $html
        );
        return $result;
    }

    /**
     * Insert newline after comment in given HTML.
     *
     * @param string $html
     *
     * @return string
     */
    protected function replaceCommentMarkerWithNewline($html)
    {
        $result = str_replace(
            static::COMMENT_MARKER,
            "\n",
            $html
        );
        return $result;
    }
}
