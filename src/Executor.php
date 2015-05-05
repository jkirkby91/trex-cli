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
     * @return bool
     */
    public function flush(
        $command,
        array $streams
    ) {
        $process = proc_open($command, $streams, $pipes);
        if (!is_resource($process)) {
            throw new \RuntimeException('Error to open the process');
        }
        return proc_close($process) === 0;
    }
}
