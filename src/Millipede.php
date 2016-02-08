<?php

namespace Millipede;

use IteratorAggregate;

/**
 * A class to generate a Millipede in PHP
 */
class Millipede implements IteratorAggregate
{
    /**
     * Millipede Config object
     *
     * @var Config
     */
    protected $config;

    /**
     * Millipede padding offsets
     *
     * @var array
     */
    protected $paddingOffsets = ['  ', ' ', '', ' ', '  ', '   ', '    ', '   '];

    /**
     * Millipede header
     *
     * @var string
     */
    protected $head = '╚⊙ ⊙╝';

    /**
     * Millipede body
     *
     * @var string
     */
    protected $body = '╚═(███)═╝';

    /**
     * a new instance
     *
     * @param Config $config
     */
    public function __construct(Config $config = null)
    {
        $this->config = $config ?: new Config();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        ob_start();
        foreach ($this->getIterator() as $part) {
            echo $part, PHP_EOL;
        }

        return ob_get_clean();
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        yield $this->config->getComment();
        yield '';
        yield $this->getHead();
        $i = 0;
        do {
            yield $this->getPadding($i).$this->getBody();
            ++$i;
        } while ($i < $this->config->getSize());
        yield '';
    }

    /**
     * Retrieve the millipede head
     *
     * @return string The Millipede head
     */
    protected function getHead()
    {
        return '    '.$this->head;
    }

    /**
     * Retrieve the Padding offset depending on the iteration
     *
     * @param int $offset
     *
     * @return string
     */
    protected function getPadding($offset)
    {
        return $this->paddingOffsets[$offset % 8];
    }

    /**
     * Retrieve the millipede body
     *
     * @return string The Millipede head
     */
    protected function getBody()
    {
        return $this->body;
    }
}
