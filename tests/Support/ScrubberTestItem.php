<?php

namespace Tests\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tests\Database\Factories\ScrubberTestItemFactory;

class ScrubberTestItem extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'scrubber_test';

    /** @var string[] */
    protected $casts = [
        'toggle' => 'boolean',
    ];

    /** @var array */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'toggle',
    ];

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getToggle(): bool
    {
        return $this->toggle;
    }

    protected static function newFactory(): ScrubberTestItemFactory
    {
        return new ScrubberTestItemFactory;
    }
}
