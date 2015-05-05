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
        $streams = $this->provideStreams();
        $executor = new Executor();
        $this->assertTrue($executor->flush('echo foo', $streams));

        rewind($streams[0]);
        $this->assertSame('', fread($streams[0], 1024));

        rewind($streams[1]);
        $this->assertSame("foo\r\n", fread($streams[1], 1024));

        rewind($streams[2]);
        $this->assertSame('', fread($streams[2], 1024));
    }

    /**
     * @return array
     */
    private function provideStreams()
    {
        return [
            fopen('php://temp', 'a+'), //input
            fopen('php://temp', 'a+'), //output
            fopen('php://temp', 'a+'), //err
        ];
    }
}
