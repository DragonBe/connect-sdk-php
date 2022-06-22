<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

use ReflectionClass;

abstract class AbstractReflectionHydrator implements HydratorInterface
{
    public function hydrate(object $object, array $data): object
    {
        return $this->reflect($object, $data);
    }

    public function extract(object $object): array
    {
        $reflectionObject = new ReflectionClass($object);
        $keyValues = array_map(function ($item) use ($object) {
            $item->setAccessible(true);
            return ['key' => $item->getName(), 'value' => $item->getValue($object)];
        }, $reflectionObject->getProperties());
        $array = [];
        foreach ($keyValues as $pair) {
            list ($key, $value) = [$pair['key'], $pair['value']];
            $array[$key] = $value;
        }
        return $array;
    }

    private function reflect(object $object, array $data): object
    {
        $reflectionObject = new ReflectionClass($object);
        foreach (array_keys($data) as $key) {
            if (! $reflectionObject->hasProperty($key)) {
                continue;
            }
            $property = $reflectionObject->getProperty($key);
            $property->setAccessible(true);
            $property->setValue($object, $data[$key]);
        }
        $args = array_map(function ($property) use ($object) {
            $property->setAccessible(true);
            return $property->getValue($object);
        }, $reflectionObject->getProperties());
        return $reflectionObject->newInstanceArgs($args);
    }
}
