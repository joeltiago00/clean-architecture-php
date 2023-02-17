<?php

namespace Infrastructure\Models\Traits;

trait Builder
{
    private bool $firstTimeWhere = true;

    public function where(string $column, string $operator, mixed $value): self
    {
        $value = is_string($value) ? "'$value'" : $value;

        if ($this->firstTimeWhere) {
            $this->conditions .= "where $column $operator $value";

            $this->firstTimeWhere = false;

            return $this;
        }

        $this->conditions .= " and $column $operator $value";

        return $this;
    }

    public function select(string $select): self
    {
        $this->select = $select;

        return $this;
    }
}