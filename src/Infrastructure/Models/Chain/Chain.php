<?php

namespace Infrastructure\Models\Chain;

class Chain
{
    private mixed $content;
    private array $handlers;

    public function with(mixed $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function through(array $handlers): self
    {
        $this->handlers = $handlers;

        return $this;
    }

    public function send(): mixed
    {
        $content = $this->content;

        foreach ($this->handlers as $handler) {
            $content = (new $handler)->handle($content);

        }

        return $content;
    }
}