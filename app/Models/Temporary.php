<?php

namespace App\Models;

class Temporary extends Model
{
    protected $table = 'temporary';
    protected $fillable = ['key', 'value'];

    protected $guarded = ['id'];

    protected $casts = [
        'value' => 'array',
    ];

    public function getData(): array
    {
        return (array)$this->value;
    }

    public function setData(array $data): Temporary
    {
        $this->setAttribute('value', $data);

        return $this;
    }
}
