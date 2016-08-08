<?php

namespace Millipede;

use InvalidArgumentException;

/**
 * A class to configure the Millipede settings
 */
class Millipede
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
    protected $head = ' ';

    /**
     * Millipede body block
     *
     * @var string
     */
    protected $skin = '█';

    /**
     * return an Array representation of the Config object
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'head' => $this->head,
            'skin' => $this->skin,
            'width' => $this->width,
            'size' => $this->size,
            'curve' => $this->curve,
            'comment' => $this->comment,
            'reverse' => $this->reverse,
            'opposite' => $this->opposite,
        ];
    }

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
    public function getSkin()
    {
        return $this->skin;
    }

    /**
     * Retrieve the head block
     *
     * @return string
     */
    public function getHead()
    {
        return $this->head;
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
     * @param string $skin The body skin pattern
     *
     * @throws InvalidArgumentException If $skin is not a single character
     *
     * @return self A new instance with the specified curve.
     */
    public function withSkin($skin)
    {
        $skin = $this->filterPattern($skin, 'skin');
        if ($skin === $this->skin) {
            return $this;
        }

        $clone = clone $this;
        $clone->skin = $skin;

        return $clone;
    }

    /**
     * Tell whether the submitted string is a valid block character
     *
     * @param string $str The submitted string
     *
     * @throws InvalidArgumentException if the pattern is invalid
     *
     * @return bool
     */
    protected function filterPattern($str, $part)
    {
        if (!is_string($str)) {
            throw new InvalidArgumentException(
                sprintf('Expected data to be a string; received "%s"', gettype($str))
            );
        }

        if (1 == mb_strlen($str)) {
            return $str;
        }

        if (preg_match(self::REGEXP_UNICODE, $str)) {
            return $this->filterUnicodeCharacter($str);
        }

        throw new InvalidArgumentException(sprintf('The %s pattern must be a single character', $part));
    }

    /**
     * decode unicode characters
     *
     * @see http://stackoverflow.com/a/37415135/2316257
     *
     * @param string $str
     *
     * @throws InvalidArgumentException if the character is not valid
     *
     * @return string
     */
    protected function filterUnicodeCharacter($str)
    {
        $replaced = preg_replace(self::REGEXP_UNICODE, '&#x$1;', $str);
        $result = mb_convert_encoding($replaced, 'UTF-16', 'HTML-ENTITIES');
        $result = mb_convert_encoding($result, 'UTF-8', 'UTF-16');
        if (1 == mb_strlen($result)) {
            return $result;
        }

        throw new InvalidArgumentException('The given string is not a valid unicode string');
    }

    /**
     * Return an instance with the head pattern.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified curve.
     *
     * @param string $head The head pattern as a single character
     *
     * @throws InvalidArgumentException If $head is not a single character
     *
     * @return self A new instance with the specified curve.
     */
    public function withHead($head)
    {
        $head = $this->filterPattern($head, 'head');
        if ($head === $this->head) {
            return $this;
        }

        $clone = clone $this;
        $clone->head = $head;

        return $clone;
    }
}
