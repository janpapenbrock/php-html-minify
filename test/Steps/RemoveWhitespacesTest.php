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

use PHPUnit_Framework_TestCase;

/**
 * Test task for removing whitespaces.
 *
 * @see RemoveWhitespaces
 */
class RemoveWhitespacesTest extends PHPUnit_Framework_TestCase
{
    /** @var RemoveWhitespaces */
    protected $subject;

    /**
     * Set up.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subject = new RemoveWhitespaces();
    }

    /**
     * Optimizer removes tabs and replaces with spaces.
     *
     * @test
     *
     * @return void
     */
    public function itRemovesTabsAndReplacesThemWithSpaces()
    {
        $input = "<html>\t</html>";
        $this->assertSame(
            '<html> </html>',
            $this->subject->apply($input)
        );
    }

    /**
     * Optimizer removes redundant spaces.
     *
     * @test
     *
     * @return void
     */
    public function itRemovesMultipleSpacesFromHTML()
    {
        $input = "<html>          <head />     <body>   </body>                                </html>";
        $this->assertSame(
            '<html> <head /> <body> </body> </html>',
            $this->subject->apply($input)
        );
    }

    /**
     * Optimizer removes tabs and replaces with spaces.
     *
     * @test
     *
     * @return void
     */
    public function itMergesTabsAndSurroundingSpacesAndReplacesThemWithSpaces()
    {
        $input = "<html> \t </html>";
        $this->assertSame(
            '<html> </html>',
            $this->subject->apply($input)
        );
    }

}
