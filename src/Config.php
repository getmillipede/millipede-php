<?php

namespace Millipede;

use InvalidArgumentException;

/**
 * A class to configure the Millipede settings
 */
class Config
{
    const REGEXP_UNICODE = '/\\\\u(?<unicode>[0-9A-F]{1,4})/i';

    /**
     * Comment string
     *
     * @var string
     */
    protected $comment = '';

    /**
     * Millipede size
     *
     * @var int
     */
    protected $size = 20;

    /**
     * Millipede width
     *
     * @var int
     */
    protected $width = 3;

    /**
     * Millipede curve
     *
     * @var int
     */
    protected $curve = 4;

    /**
     * Millipede reverse status
     *
     * @var bool
     */
    protected $reverse = false;

    /**
     * Millipede opposite status
     *
     * @var bool
     */
    protected $opposite = false;

    /**
     * Millipede head block
     *
     * @var string
     */
    protected $head_block = ' ';

    /**
     * Millipede body block
     *
     * @var string
     */
    protected $body_block = '█';

    /**
     * Retrieve the comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Retrieve the size
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Retrieve the size
     *
     * @return int
     */
    public function getCurve()
    {
        return $this->curve;
    }

    /**
     * Retrieve the width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Retrieve the body block
     *
     * @return string
     */
    public function getBodyBlock()
    {
        return $this->body_block;
    }

    /**
     * Retrieve the head block
     *
     * @return string
     */
    public function getHeadBlock()
    {
        return $this->head_block;
    }

    /**
     * Tell whether the Millipede must be reverse
     *
     * @return bool
     */
    public function isReverse()
    {
        return $this->reverse;
    }

    /**
     * Tell whether the Millipede must be opposite
     *
     * @return bool
     */
    public function isOpposite()
    {
        return $this->opposite;
    }

    /**
     * Return an instance with the specified comment.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified comment string.
     *
     * @param string $comment The comment to use with the new instance.
     *
     * @return self A new instance with the specified comment.
     */
    public function withComment($comment)
    {
        if (!is_string($comment)) {
            throw new InvalidArgumentException(
                sprintf('Expected data to be a string; received "%s"', gettype($comment))
            );
        }

        if ($comment === $this->comment) {
            return $this;
        }
        $clone = clone $this;
        $clone->comment = $comment;

        return $clone;
    }

    /**
     * Return an instance with the specified size.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified size.
     *
     * @param int $size The size to use with the new instance.
     *
     * @return self A new instance with the specified size.
     */
    public function withSize($size)
    {
        $size = $this->validateInteger($size, 1, 20);
        if ($size === $this->size) {
            return $this;
        }
        $clone = clone $this;
        $clone->size = $size;

        return $clone;
    }

    /**
     * Validate an Integer
     *
     * @param int $int
     * @param int $min
     * @param int $default
     *
     * @return int
     */
    protected function validateInteger($int, $min, $default)
    {
        $int = filter_var($int, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, 'default' => $default]]);
        if (false === $int) {
            throw new InvalidArgumentException(
                sprintf('Expected data to be a int; received "%s"', gettype($int))
            );
        }

        return $int;
    }

    /**
     * Return an instance with the specified curve.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified curve.
     *
     * @param int $curve The size to use with the new instance.
     *
     * @return self A new instance with the specified curve.
     */
    public function withCurve($curve)
    {
        $curve = $this->validateInteger($curve, 0, 4);
        if ($curve === $this->curve) {
            return $this;
        }
        $clone = clone $this;
        $clone->curve = $curve;

        return $clone;
    }

    /**
     * Return an instance with the specified reverse state.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified curve.
     *
     * @param bool $reverse Tell wether the Millipede should be reverse or not
     *
     * @return self A new instance with the specified curve.
     */
    public function withReverse($status)
    {
        $status = (bool) $status;
        if ($status === $this->reverse) {
            return $this;
        }
        $clone = clone $this;
        $clone->reverse = $status;

        return $clone;
    }

    /**
     * Return an instance with the specified opposite state.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified curve.
     *
     * @param bool $reverse Tell wether the Millipede should be opposite or not
     *
     * @return self A new instance with the specified curve.
     */
    public function withOpposite($status)
    {
        $status = (bool) $status;
        if ($status === $this->opposite) {
            return $this;
        }
        $clone = clone $this;
        $clone->opposite = $status;

        return $clone;
    }

    /**
     * Return an instance with the specified curve.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified curve.
     *
     * @param int $curve The size to use with the new instance.
     *
     * @return self A new instance with the specified curve.
     */
    public function withWidth($width)
    {
        $width = $this->validateInteger($width, 3, 3);
        if ($width === $this->width) {
            return $this;
        }
        $clone = clone $this;
        $clone->width = $width;

        return $clone;
    }

    /**
     * Return an instance with the specified body block.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified curve.
     *
     * @param string $block The body block character
     *
     * @throws InvalidArgumentException If $block is not a single character
     *
     * @return self A new instance with the specified curve.
     */
    public function withBodyBlock($block)
    {
        $block = $this->validateBlock($block, 'body');
        if ($block === $this->body_block) {
            return $this;
        }

        $clone = clone $this;
        $clone->body_block = $block;

        return $clone;
    }

    /**
     * Tell whether the submitted string is a valid block character
     *
     * @param string $str The submitted string
     *
     * @return bool
     */
    protected function validateBlock($str, $part)
    {
        if (!is_string($str)) {
            throw new InvalidArgumentException(
                sprintf('Expected data to be a string; received "%s"', gettype($str))
            );
        }

        if (preg_match(self::REGEXP_UNICODE, $str)) {
            $str = $this->decodeUnicode($str);
        }

        if (1 == mb_strlen($str)) {
            return $str;
        }

        throw new InvalidArgumentException(sprintf('The %s block must be a single character', $part));
    }

    /**
     * decode unicode characters
     *
     * @see http://stackoverflow.com/a/37415135/2316257
     *
     * @param string $str
     *
     * @return string
     */
    protected function decodeUnicode($str)
    {
        $replaced = preg_replace(self::REGEXP_UNICODE, '&#x$1;', $str);
        $result = mb_convert_encoding($replaced, 'UTF-16', 'HTML-ENTITIES');

        return mb_convert_encoding($result, 'UTF-8', 'UTF-16');
    }

    /**
     * Return an instance with the specified head block.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified curve.
     *
     * @param string $block The head block character
     *
     * @throws InvalidArgumentException If $block is not a single character
     *
     * @return self A new instance with the specified curve.
     */
    public function withHeadBlock($block)
    {
        $block = $this->validateBlock($block, 'head');
        if ($block === $this->head_block) {
            return $this;
        }

        $clone = clone $this;
        $clone->head_block = $block;

        return $clone;
    }
}
