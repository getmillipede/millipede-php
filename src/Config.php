<?php

namespace Millipede;

class Config
{
    protected $comment = '';

    protected $size = 20;

    public function withComment($comment)
    {
        $comment = (string) $comment;
        if ($comment == $this->comment) {
            return $this;
        }
        $clone = clone $this;
        $clone->comment = $comment;

        return $clone;
    }

    public function withSize($size)
    {
        $size = filter_var($size, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'default' => 20]]);
        if ($size == $this->size) {
            return $this;
        }
        $clone = clone $this;
        $clone->size = $size;

        return $clone;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getSize()
    {
        return $this->size;
    }
}
