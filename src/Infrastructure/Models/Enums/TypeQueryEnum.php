<?php

namespace Infrastructure\Models\Enums;

enum TypeQueryEnum
{
    case INSERT;
    case UPDATE;
    case DELETE;
    case CREATE_TABLE;
    case DROP;
    case SELECT;

    public function text(): string
    {
        return match ($this) {
            self::INSERT => 'insert into {table} ({columns}) values ({values})',
            self::UPDATE => 'update {table} set {updates} {conditions}',
            self::DELETE => 'delete from {table} {conditions}',
            self::CREATE_TABLE => 'create table {table} {columns}',
            self::DROP => 'drop table if exists {table}',
            self::SELECT => 'select {select} {columns} from {table} {conditions}',
        };
    }
}
