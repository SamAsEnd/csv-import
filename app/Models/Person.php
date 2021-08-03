<?php

namespace App\Models;

use Illuminate\Contracts\Support\Arrayable;

class Person implements Arrayable
{
    protected string $name;
    protected string $address;
    protected string $phone;
    protected array $tags;
    protected int $id;

    public function __construct($object, $index = 'whatever')
    {
        $this->name = $object[0];
        $this->address = $object[1];
        $this->phone = $object[2];
        $this->tags = explode(',', $object[3]);
        $this->id = intval($object[4]);
    }

    public function toArray()
    {
        return [
            $this->name,
            $this->address,
            $this->phone,
            implode(',', $this->tags),
            $this->id,
        ];
    }
}