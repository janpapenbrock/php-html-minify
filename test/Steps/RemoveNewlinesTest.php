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
 * Test task for removing newlines.
 *
 * @see RemoveNewlines
 */
class RemoveNewlinesTest extends PHPUnit_Framework_TestCase
{
    /** @var RemoveNewlines */
    protected $subject;

    /**
     * Set up.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subject = new RemoveNewlines();
    }

    /**
     * Optimizer removes HTML newlines and replaces with spaces.
     *
     * @test
     *
     * @return void
     */
    public function itRemovesNewlinesAndReplacesThemWithSpaces()
    {
        $input = '<html>
<head />
<body>
    <h2>Hello World!</h2>
</body>
</html>';
        $this->assertSame(
            '<html> <head /> <body>     <h2>Hello World!</h2> </body> </html>',
            $this->subject->apply($input)
        );
    }

    /**
     * Optimizer removes HTML newlines and replaces with spaces.
     *
     * @test
     *
     * @return void
     */
    public function itRemovesCarriageReturnsFromHTML()
    {
        $input = "<html>\r</html>";
        $this->assertSame(
            '<html> </html>',
            $this->subject->apply($input)
        );
    }

    /**
     * Optimizer removes HTML newlines and replaces with spaces.
     *
     * @test
     *
     * @return void
     */
    public function itRemovesCarriageReturnsAndLineFeedsWithASingleSpaceFromHTML()
    {
        $input = "<html>\r\n</html>";
        $this->assertSame(
            '<html> </html>',
            $this->subject->apply($input)
        );
    }

    /**
     * Optimizer keeps newlines when needed after JavaScript comments
     *
     * @test
     *
     * @return void
     */
    public function itKeepsNewlinesAfterJavaScriptComments()
    {
        $input = "<script>
//<![CDATA[
var skipTierPricePercentUpdate = true;

if (skipTierPricePercentUpdate) {
    // leap year assumption for unknown year
    return 29;
}";
        $this->assertSame(
            '<script> //<![CDATA[
 var skipTierPricePercentUpdate = true;  if (skipTierPricePercentUpdate) {     // leap year assumption for unknown year
     return 29; }',
            $this->subject->apply($input)
        );
    }

    /**
     * Optimizer does not keep newlines after lines containing hyperlinks
     *
     * @test
     *
     * @return void
     */
    public function itDoesNotKeepNewlinesAfterHyperlink()
    {
        $input = '<a href="http://www.example.com/link">
    SuperLink
</a>';
        $this->assertSame(
            '<a href="http://www.example.com/link">     SuperLink </a>',
            $this->subject->apply($input)
        );
    }

}
