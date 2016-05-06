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

use PHPUnit_Framework_TestCase;

/**
 * Test the minifyer. It should load and apply steps.
 *
 * @see HtmlMinify
 */
class HtmlMinifyTest extends PHPUnit_Framework_TestCase
{
    /** @var HtmlMinify */
    protected $subject;

    /**
     * Set up.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subject = new HtmlMinify();
    }

    /**
     * It reads all steps from steps directory, but not interface.
     *
     * @test
     *
     * @return void
     */
    public function itReadsStepsWithoutInterface()
    {
        $optimizers = $this->subject->getSteps();

        $this->assertArrayNotHasKey(
            'Task',
            $optimizers
        );
    }

    /**
     * It reads all steps from steps directory.
     *
     * @test
     *
     * @return void
     */
    public function itShouldInstantiateAllSteps()
    {
        $optimizers = $this->subject->getSteps();
        $this->assertCount(3, $optimizers);
    }

    /**
     * All steps should implement the step interface.
     *
     * @test
     *
     * @return void
     */
    public function itHasOnlyStepsImplementingStep()
    {
        $optimizers = $this->subject->getSteps();

        foreach ($optimizers as $step) {
            $this->assertInstanceOf(
                'janpapenbrock\HtmlMinify\Steps\Step',
                $step
            );
        }
    }

}
