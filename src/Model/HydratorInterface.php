<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

interface HydratorInterface
{
    public function hydrate(object $object, array $data): object;
    public function extract(object $object): array;
}
