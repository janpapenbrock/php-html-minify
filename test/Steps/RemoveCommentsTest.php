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
 * Test task for removing HTML comments.
 *
 * @see RemoveComments
 */
class RemoveCommentsTest extends PHPUnit_Framework_TestCase
{
    /** @var RemoveComments */
    protected $subject;

    /**
     * Set up.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subject = new RemoveComments();
    }

    /**
     * Optimizer removes HTML comments with start and end tag in the same line.
     *
     * @test
     *
     * @return void
     */
    public function itRemovesHtmlCommentInSingleLine()
    {
        $input = '<html><head /><body><!-- headline --><h2>Hello World!</h2></body></html>';
        $this->assertSame(
            '<html><head /><body><h2>Hello World!</h2></body></html>',
            $this->subject->apply($input)
        );
    }

    /**
     * Optimizer removes HTML comments with start and end tag in different lines.
     *
     * @test
     *
     * @return void
     */
    public function itRemovesHtmlCommentInMultipleLine()
    {
        $input = '<html><head /><body><!--
        headline
        --><h2>Hello World!</h2></body></html>';
        $this->assertSame(
            '<html><head /><body><h2>Hello World!</h2></body></html>',
            $this->subject->apply($input)
        );
    }

    /**
     * Optimizer removes multiple HTML comments.
     *
     * @test
     *
     * @return void
     */
    public function itRemovesMultipleHtmlComments()
    {
        $input = '<html><head /><body><!--
        headline
        --><h2>Hello World!</h2><!-- not being greedy --></body></html>';
        $this->assertSame(
            '<html><head /><body><h2>Hello World!</h2></body></html>',
            $this->subject->apply($input)
        );
    }

    /**
     * Optimizer removes multiple HTML comments.
     *
     * @test
     *
     * @return void
     */
    public function itKeepsConditionalComments()
    {
        $input = '<!DOCTYPE html>

<!--[if lt IE 7 ]> <html lang="de" id="top" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="de" id="top" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="de" id="top" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="de" id="top" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="de" id="top" class="no-js"> <!--<![endif]-->';
        $this->assertSame(
            $input,
            $this->subject->apply($input)
        );
    }
}
