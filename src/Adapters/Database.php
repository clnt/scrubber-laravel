<?php

namespace ClntDev\LaravelScrubber\Adapters;

use ClntDev\Scrubber\Contracts\DatabaseUpdate;
use Illuminate\Support\Facades\DB;

class Database implements DatabaseUpdate
{
    public function fetch(string $table, string $primaryKey): array
    {
        return DB::connection(config('scrubber.default_connection'))
            ->table($table)
            ->pluck($primaryKey)
            ->toArray();
    }

    public function update(
        string $table,
        string $field,
        mixed $value,
        string|int $primaryKeyValue,
        string $primaryKey = 'id'
    ): bool {
        return DB::connection(config('scrubber.default_connection'))
            ->table($table)
            ->where($primaryKey, $primaryKeyValue)
            ->update([$field => $value]);
    }
}
