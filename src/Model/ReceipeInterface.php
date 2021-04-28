<?php

namespace OnePassword\Connect\Model;

interface ReceipeInterface
{
    public function getLength(): int;
    public function getCharacterSets(): array;
}
