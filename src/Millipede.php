<?php

namespace Millipede;

use IteratorAggregate;

class Millipede implements IteratorAggregate
{
    /**
     * Millipede Config object
     *
     * @var Config
     */
    protected $config;

    protected $paddingOffsets = ['  ', ' ', '', ' ', '  ', '   ', '    ', '   '];

    protected $head = '╚⊙ ⊙╝';

    protected $body = '╚═(███)═╝';

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getHead()
    {
        return '    '.$this->head;
    }

    public function getBody()
    {
        return $this->body;
    }

    protected function getPadding($i)
    {
        return $this->paddingOffsets[$i % 8];
    }

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

    public function __toString()
    {
        ob_start();
        foreach ($this->getIterator() as $part) {
            echo $part, PHP_EOL;
        }
        return ob_get_clean();
    }
}
