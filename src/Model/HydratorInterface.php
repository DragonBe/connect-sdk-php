<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

interface HydratorInterface
{
    /**
     * Hydarate an object with data
     *
     * @param object $object
     * @param array $data
     * @return object
     */
    public function hydrate(object $object, array $data): object;

    /**
     * Extract data from an object
     *
     * @param object $object
     * @return array
     */
    public function extract(object $object): array;
}
