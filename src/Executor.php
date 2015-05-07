<?php
namespace TRex\Cli;

/**
 * Class Executor
 * Execute commands
 *
 * @package TRex\Cli
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Executor
{
    /**
     * reads the result of a command.
     *
     * @param string $command
     * @param string $eol
     * @return string
     */
    public function read($command, $eol = PHP_EOL)
    {
        exec($command, $output);
        return implode($eol, $output);
    }

    /**
     * Links the command with the current STD streams.
     *
     * @param string $command
     * @param array $streams
     * @param array $pipes
     * @param string $cwd
     * @param array $env
     * @param array $options
     * @return int
     */
    public function flush(
        $command,
        array $streams,
        array &$pipes = [],
        $cwd = null,
        array $env = null,
        array $options = []
    ) {
        $process = proc_open($command, $streams, $pipes, $cwd, $env, $options);
        if (!is_resource($process)) {
            throw new \RuntimeException('Error to open the process');
        }
        return proc_close($process);
    }
}
