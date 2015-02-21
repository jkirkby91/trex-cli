<?php
namespace TRex\Cli;

/**
 * Class ExecutorTest
 * @package TRex\Cli
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ExecutorTest extends \PHPUnit_Framework_TestCase
{

    public function testRead()
    {
        $executor = new Executor();
        $this->assertSame('foo'.PHP_EOL.'bar', $executor->read('echo foo && echo bar'));
    }

    public function testFlush()
    {
        $executor = new Executor();
        $this->assertTrue($executor->flush('echo foo'));
    }
}
