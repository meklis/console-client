<?php

namespace Meklis\Network\Console;

use Meklis\Network\Console\Helpers\DefaultHelper;
use Meklis\Network\Console\Helpers\HelperInterface;

abstract class AbstractConsole
{
    protected $host;
    protected $port;
    protected $timeout;
    protected $stream_timeout_sec;
    protected $stream_timeout_usec;

    /**
     * @var HelperInterface
     */
    protected $helper;

    protected $buffer = null;
    protected $prompt;
    protected $errno;
    protected $errstr;
    protected $eol = "\n";
    protected $enableMagicControl = true;
    protected $NULL;
    protected $DC1;
    protected $WILL;
    protected $WONT;
    protected $DO;
    protected $DONT;
    protected $IAC;
    protected $SB;
    protected $NAWS;
    protected $SE;

    protected $global_buffer;

    /**
     * Constructor. Initialises host, port and timeout parameters
     * defaults to localhost port 23 (standard telnet port)
     *
     * @param string $host Host name or IP addres
     * @param int $port TCP port number
     * @param int $timeout Connection timeout in seconds
     * @param float $stream_timeout Stream timeout in decimal seconds
     * @throws \Exception
     */
    public function __construct($timeout = 10, $stream_timeout = 1.0)
    {
        $this->timeout = $timeout;
        $this->setStreamTimeout($stream_timeout);

        // set some telnet special characters
        $this->NULL = chr(0);
        $this->DC1 = chr(17);
        $this->WILL = chr(251);
        $this->SB = chr(250);
        $this->SE = chr(240);
        $this->NAWS = chr(31);
        $this->WONT = chr(252);
        $this->DO = chr(253);
        $this->DONT = chr(254);
        $this->IAC = chr(255);

        // open global buffer stream
        $this->global_buffer = new \SplFileObject('php://temp', 'r+b');
        $this->helper = new DefaultHelper();
    }

    /**
     * @param HelperInterface $helper
     * @return $this
     */
    function setDeviceHelper(HelperInterface $helper)
    {
        $this->helper = $helper;

        if ($this->helper->getEol()) {
            $this->eol = $this->helper->getEol();
        }
        if ($this->helper->getPrompt()) {
            $this->prompt = $this->helper->getPrompt();
        }
        $this->enableMagicControl = $this->helper->isEnableMagicControl();
        return $this;
    }

    /**
     * Destructor. Cleans up socket connection and command buffer
     *
     * @return void
     */
    public function __destruct()
    {
        // clean up resources
        $this->disconnect();
        $this->buffer = null;
    }

    /**
     * Disable sending magic symbols for wait
     *
     * @return $this
     */
    public function disableMagicControl()
    {
        $this->enableMagicControl = false;
        return $this;
    }

    /**
     * Enable sending magic symbols for wait
     *
     * @return $this
     */
    public function enableMagicControl()
    {
        $this->enableMagicControl = true;
        return $this;
    }

    /**
     * Setted EOL symbol for new line in linux style (\n)
     *
     * @return $this
     */
    public function setLinuxEOL()
    {
        $this->eol = "\n";
        return $this;
    }

    /**
     * Setted EOL symbol for new line in windows style (\r\n)
     *
     * @return $this
     */
    public function setWinEOL()
    {
        $this->eol = "\r\n";
        return $this;
    }

    /**
     * Executes command and returns a string with result.
     * This method is a wrapper for lower level private methods
     *
     * @param string $command Command to execute
     * @param boolean $add_newline Default true, adds newline to the command
     * @return string Command result
     */
    public function exec($command, $add_newline = true, $prompt = null)
    {
        $this->write($command, $add_newline);
        $this->waitPrompt($prompt);
        $buffer =  $this->getBuffer();
        if($lines = explode("\n", $buffer)) {
            if(isset($lines[0]) && trim($command) && strpos($lines[0], $command) !== false) {
                unset($lines[0]);
            }
            return  $this->removeNotASCIISymbols(implode("\n", $lines));
        }
        return $this->removeNotASCIISymbols($buffer);
    }

    protected function removeNotASCIISymbols($chars)
    {
        if (!mb_detect_encoding($chars, 'ASCII', true)) {
            $chars = str_split($chars);
            foreach ($chars as $num => $char) {
                if (!mb_detect_encoding($char, 'ASCII', true)) {
                    unset($chars[$num]);
                }
            }
            return implode('',$chars);
        }
        return $chars;
    }

    /**
     * Sets the string of characters to respond to.
     * This should be set to the last character of the command line prompt
     *
     * @param string $str String to respond to
     * @return $this
     */
    public function setPrompt($str)
    {
        $this->setRegexPrompt(preg_quote($str, '/'));
        return $this;
    }

    /**
     * Sets a regex string to respond to.
     * This should be set to the last line of the command line prompt.
     *
     * @param string $str Regex string to respond to
     * @return $this
     */
    public function setRegexPrompt($str)
    {
        $this->prompt = $str;
        return $this;
    }

    /**
     * Sets the stream timeout.
     *
     * @param float $timeout
     * @return void
     */
    public function setStreamTimeout($timeout)
    {
        $this->stream_timeout_usec = (int)(fmod($timeout, 1) * 1000000);
        $this->stream_timeout_sec = (int)$timeout;
    }


    /**
     * Clears internal command buffer
     *
     * @return $this
     */
    public function clearBuffer()
    {
        $this->buffer = '';
        return $this;
    }

    /**
     * Returns the content of the command buffer
     *
     * @return string Content of the command buffer
     */
    function getBuffer()
    {
        // Remove all carriage returns from line breaks
        $buf = str_replace(["\n\r", "\r\n", "\n", "\r"], "\n", $this->buffer);
        // Cut last line from buffer (almost always prompt)
        if ($this->helper->isStripPrompt()) {
            $buf = explode("\n", $buf);
            unset($buf[count($buf) - 1]);
            $buf = implode("\n", $buf);
        }
        return trim($buf);
    }

    /**
     * Returns the content of the global command buffer
     *
     * @return string Content of the global command buffer
     */
    public function getGlobalBuffer()
    {
        $this->global_buffer->rewind();
        $output = '';
        while (!$this->global_buffer->eof()) {
            $output .= $this->global_buffer->fgets();
        }
        return mb_convert_encoding($output, 'UTF-8', 'UTF-8');
    }

    /**
     * Reads socket until prompt is encountered
     */
    public function waitPrompt($prompt = null)
    {
        if ($prompt === null) {
            $prompt = $this->prompt;
        }
        return $this->readTo($prompt);
    }

    function runAfterLoginCommands() {
        foreach ($this->helper->getAfterLoginCommands() as $command) {
            if(is_string($command)) {
                $this->exec($command);
            }
            if(is_array($command)) {
                if(isset($command['no_wait']) && $command['no_wait']) {
                    $this->write($command['command']);
                } else {
                    $this->exec($command['command']);
                }
                if(isset($command['usleep']) && $command['usleep']) {
                    usleep($command['usleep']);
                }
            }
        }
        return $this;
    }
    function runBeforeLogountCommands() {
        foreach ($this->helper->getBeforeLogoutCommands() as $command) {
            if(is_string($command)) {
                $this->exec($command);
            }
            if(is_array($command)) {
                if(isset($command['no_wait']) && $command['no_wait']) {
                    $this->write($command['command']);
                } else {
                    $this->exec($command['command']);
                }
                if(isset($command['usleep']) && $command['usleep']) {
                    usleep($command['usleep']);
                }
            }
        }
        return $this;
    }

    abstract function disconnect();

    abstract function write($command, $add_newline);

    abstract function setWindowSize($wide, $high);

    abstract function connect($host, $port, HelperInterface $helper = null);

    abstract function login($username, $password);
}