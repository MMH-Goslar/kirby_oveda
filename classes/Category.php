<?php

namespace Kirby\Events;

class Category {
    public int $id;
    public string $name;

    public function __construct(int $id, string $name = "") {
        $this->id = $id;
        $this->name = $name;
    }
}

?>