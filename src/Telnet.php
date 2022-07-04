<?php

namespace Meklis\Network\Console;

use Meklis\Network\Console\Helpers\HelperInterface;

/**
 * Telnet class
 *
 * Used to execute remote commands via telnet connection
 * Usess sockets functions and fgetc() to process result
 *
 * All methods throw Exceptions on error
 */
class Telnet extends AbstractConsole implements ConsoleInterface
{
    protected $socket = null;

    public function connect($host, $port = 23, ?HelperInterface $helper = null)
    {
        if ($helper) {
            $this->helper = $helper;
        }
        $this->host = $host;
        $this->port = $port;
        // check if we need to convert host to IP
        if (!preg_match('/([0-9]{1,3}\\.){3,3}[0-9]{1,3}/', $this->host)) {
            $ip = gethostbyname($this->host);

            if ($this->host == $ip) {
                throw new \Exception("Cannot resolve $this->host");
            } else {
                $this->host = $ip;
            }
        }
        if ($this->helper->getEol()) {
            $this->eol = $this->helper->getEol();
        }
        if ($this->helper->getPrompt()) {
            $this->prompt = $this->helper->getPrompt();
        }
        $this->enableMagicControl = $this->helper->isEnableMagicControl();
        // attempt connection - suppress warnings
        $this->socket = @fsockopen($this->host, $this->port, $this->errno, $this->errstr, $this->timeout);
        if (!$this->socket) {
            throw new \Exception("Cannot connect to $this->host on port $this->port");
        }
        if ($sizes = $this->helper->getWindowSize()) {
            $this->setWindowSize($sizes[0], $sizes[1]);
        }

        return $this;
    }

    /**
     * Closes IP socket
     *
     * @return $this
     * @throws \Exception
     */
    public function disconnect()
    {
        if ($this->socket) {
            $this->runBeforeLogountCommands();
            if (!fclose($this->socket)) {
                throw new \Exception("Error while closing telnet socket");
            }
            $this->socket = null;
        }
        return $this;
    }

    /**
     * @param $wide
     * @param $high
     * @return $this
     * @throws \Exception
     */
    public function setWindowSize($wide = 80, $high = 40)
    {
        fwrite($this->socket, $this->IAC . $this->WILL . $this->NAWS);
        $c = $this->getc();
        if ($c != $this->IAC) {
            throw new \Exception('Error: unknown control character ' . ord($c));
        }
        $c = $this->getc();
        if ($c == $this->DONT || $c == $this->WONT) {
            throw new \Exception("Error: server refuses to use NAWS");
        } elseif ($c != $this->DO && $c != $this->WILL) {
            throw  new \Exception('Error: unknown control character ' . ord($c));
        }
        fwrite($this->socket, $this->IAC . $this->SB . $this->NAWS . 0 . $wide . 0 . $high . $this->IAC . $this->SE);
        return $this;
    }

    /**
     * Attempts login to remote host.
     * This method is a wrapper for lower level private methods and should be
     * modified to reflect telnet implementation details like login/password
     * and line prompts. Defaults to standard unix non-root prompts
     *
     * @param string $username Username
     * @param string $password Password
     * @param string $host_type Type of destination host
     * @return $this
     * @throws \Exception
     */
    public function login($username, $password)
    {
        try {
            // username
            if (!empty($username)) {
                $this->setPrompt($this->helper->getUserPrompt());
                $this->waitPrompt();
                $this->write(trim($username));
            }

            // password
            $this->setPrompt($this->helper->getPasswordPrompt());
            $this->waitPrompt();
            $this->write(trim($password));

            // wait prompt
            $this->setRegexPrompt($this->helper->getPrompt());
            $this->waitPrompt();
            if ($this->helper->isDoubleLoginPrompt()) {
                $this->waitPrompt();
            }
        } catch (\Exception $e) {
            throw new \Exception("Login failed. {$e->getMessage()}");
        }
        $this->runAfterLoginCommands();

        return $this;
    }

    /**
     * Gets character from the socket
     *
     * @return string $c character string
     */
    protected function getc()
    {
        stream_set_timeout($this->socket, $this->stream_timeout_sec, $this->stream_timeout_usec);
        $c = fgetc($this->socket);
        $this->global_buffer->fwrite($c);
        return $c;
    }

    /**
     * Reads characters from the socket and adds them to command buffer.
     * Handles telnet control characters. Stops when prompt is ecountered.
     *
     */
    protected function readTo($prompt)
    {
        if (!$this->socket) {
            throw new \Exception("Telnet connection closed");
        }

        // clear the buffer
        $this->clearBuffer();

        $until_t = time() + $this->timeout;
        do {
            // time's up (loop can be exited at end or through continue!)
            if (time() > $until_t) {
                throw new \Exception("Couldn't find the requested : '$prompt' within {$this->timeout} seconds");
            }

            $c = $this->getc();
            if ($c === false) {
                if (empty($prompt)) {
                    return $this;
                }
                throw new \Exception("Couldn't find the requested : '" . $prompt . "', it was not in the data returned from server: " . $this->buffer);
            }

            // Interpreted As Command
            if ($c == $this->IAC) {
                if ($this->negotiateTelnetOptions()) {
                    continue;
                }
            }

            // append current char to global buffer
            $this->buffer .= $c;
            if ($this->helper->getPaginationDetect()) {
                if(preg_match($this->helper->getPaginationDetect(), $this->buffer)) {
                    $this->buffer = preg_replace($this->helper->getPaginationDetect(), "\n", trim($this->buffer));
                    if (!fwrite($this->socket, "\n") < 0) {
                        throw new \Exception("Error writing to socket");
                    }
                    continue;
                }
            }

            // we've encountered the prompt. Break out of the loop
            if (!empty($prompt) && preg_match("/{$prompt}$/", $this->buffer)) {
                return $this;
            }

        } while ($c != $this->NULL || $c != $this->DC1);
    }

    /**
     * @param $buffer
     * @param $add_newline
     * @return $this
     * @throws \Exception
     */
    public function write($buffer, $add_newline = true)
    {
        if ($this->socket === null) {
            throw new \Exception("Telnet connection closed! Check you call method connect() before any calling");
        }
        // clear buffer from last command
        $this->clearBuffer();

        if ($add_newline == true) {
            $buffer .= $this->eol;
        }
        $this->global_buffer->fwrite($buffer);
        if (!fwrite($this->socket, $buffer) < 0) {
            throw new \Exception("Error writing to socket");
        }

        return $this;
    }

    /**
     * Telnet control character magic
     *
     * @return bool
     * @throws \Exception
     * @internal param string $command Character to check
     */
    protected function negotiateTelnetOptions()
    {
        if (!$this->enableMagicControl) return true;

        $c = $this->getc();
        if ($c != $this->IAC) {
            if (($c == $this->DO) || ($c == $this->DONT)) {
                $opt = $this->getc();
                fwrite($this->socket, $this->IAC . $this->WONT . $opt);
            } else if (($c == $this->WILL) || ($c == $this->WONT)) {
                $opt = $this->getc();
                fwrite($this->socket, $this->IAC . $this->DONT . $opt);
            } else {
                throw new \Exception('ErrorNegotiate: unknown control character ' . ord($c));
            }
        } else {
            throw new \Exception('ErrorNegotiate: Something Wicked Happened');
        }

        return true;
    }

}