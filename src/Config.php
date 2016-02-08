<?php

namespace Millipede;

use InvalidArgumentException;

/**
 * A class to configure the Millipede settings
 */
class Config
{
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
     * Retrieve the comment
     *
     * @return string The Millipede comment string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Retrieve the size
     *
     * @return int The Millipede size
     */
    public function getSize()
    {
        return $this->size;
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
            throw new InvalidArgumentException(sprintf(
                __METHOD__.' expected data to be a string; received "%s"',
                (is_object($comment) ? get_class($comment) : gettype($comment))
            ));
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
        $size = filter_var($size, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'default' => 20]]);
        if (false === $size) {
            throw new InvalidArgumentException(sprintf(
                __METHOD__.' expected data to be a int; received "%s"',
                (is_object($size) ? get_class($size) : gettype($size))
            ));
        }
        if ($size === $this->size) {
            return $this;
        }
        $clone = clone $this;
        $clone->size = $size;

        return $clone;
    }
}
