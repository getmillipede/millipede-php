<?php

namespace Millipede;

use IteratorAggregate;

/**
 * A class to generate a Millipede in PHP
 */
class Renderer implements IteratorAggregate
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
    protected $paddingOffsets = [''];

    /**
     * Millipede header up
     *
     * @var string
     */
    protected $head_up = '╚⊙ ⊙╝';

    /**
     * Millipede header down
     *
     * @var string
     */
    protected $head_down = '╔⊙ ⊙╗';

    /**
     * Millipede body up
     *
     * @var string
     */
    protected $body_up = '╚═(███)═╝';

    /**
     * Millipede body down
     *
     * @var string
     */
    protected $body_down = '╔═(███)═╗';

    /**
     * Millipede parts
     *
     * @var array
     */
    protected $parts = [];

    /**
     * a new instance
     *
     * @param Config $config
     */
    public function __construct(Millipede $config = null)
    {
        $this->config = $config ?: new Millipede();
        $this->initHead();
        $this->initBody();
        $this->initPaddingOffsets();
    }

    /**
     * Format the Millipede head
     */
    protected function initHead()
    {
        $head = $this->head_up;
        if ($this->config->isReverse()) {
            $head = $this->head_down;
        }

        $repeat = $this->config->getCurve();
        if (0 === $repeat) {
            $repeat = 2; //to align the head with the body
        }

        $this->parts['head'] = str_repeat(' ', $repeat).str_replace(
            ' ',
            str_repeat($this->config->getHead(),  $this->config->getWidth() - 2),
            $head
        );
    }

    /**
     * Format the Millipede Body
     *
     * @param string $body the default millipede body
     *
     * @return string
     */
    protected function initBody()
    {
        $body = $this->body_up;
        if ($this->config->isReverse()) {
            $body = $this->body_down;
        }

        $this->parts['body'] = str_replace(
            '███',
            str_repeat($this->config->getSkin(), $this->config->getWidth()),
            $body
        );
    }

    /**
     * initialize Millipede padding offsets according to the config
     */
    protected function initPaddingOffsets()
    {
        $this->parts['max_curve'] = $this->config->getCurve() * 2;
        if (0 < $this->config->getCurve()) {
            for ($index = 1; $index <= $this->parts['max_curve']; ++$index) {
                $delta = $index % $this->parts['max_curve'];
                $size = (int) min($delta, $this->parts['max_curve'] - $delta);
                $this->paddingOffsets[] = str_repeat(' ', $size);
            }
        }
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
        yield '';

        $comment = $this->config->getComment();
        if (!$this->config->isReverse() && '' !== $comment) {
            yield ' '.$comment;
            yield '';
        }

        for ($offset = 0, $size = $this->config->getSize(); $offset <= $size; ++$offset) {
            yield $this->getPart($offset);
        }

        if ($this->config->isReverse() && '' !== $comment) {
            yield '';
            yield ' '.$comment;
        }

        yield '';
    }

    /**
     * Return a Millipede part according to the given offset
     *
     * @param int $offset the body part offset
     *
     * @return string
     */
    protected function getPart($offset)
    {
        if ($this->config->isReverse()) {
            $offset = $this->config->getSize() - $offset;
        }

        $content = $this->parts['body'];
        if (0 === $offset) {
            $content = $this->parts['head'];
        }

        return $this->getPadding($offset).$content;
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
        $curve = $this->config->getCurve();
        if (0 === $curve) {
            return '';
        }

        if ($this->config->isOpposite()) {
            $offset += $curve - 1;
        }

        return $this->paddingOffsets[$offset % $this->parts['max_curve']];
    }
}
