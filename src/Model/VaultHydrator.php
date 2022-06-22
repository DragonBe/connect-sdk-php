<?php

namespace OnePassword\Connect\Model;

class VaultHydrator implements HydratorInterface
{
    private const PROTO_ARRAY = [
        'id' => '',
        'name' => '',
        'attributeVersion' => 0,
        'contentVersion' => 0,
        'items' => 0,
        'type' => '',
        'createdAt' => '',
        'updatedAt' => '',
    ];

    /**
     * @inheritDoc
     */
    public function hydrate(object $object, array $data): object
    {
        $entry = array_merge(self::PROTO_ARRAY, $data);
        return new Vault(
            $entry['id'] ?: '',
            $entry['name'] ?: '',
            $entry['attributeVersion'] ?: 0,
            $entry['contentVersion'] ?: 0,
            $entry['items'] ?: 0,
            $entry['type'] ?: '',
            $entry['createdAt'] ?: '',
            $entry['updatedAt'] ?: ''
        );
    }

    /**
     * @inheritDoc
     */
    public function extract(object $object): array
    {
        if (! $object instanceof VaultInterface) {
            return [];
        }
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'attributeVersion' => $object->getAttributeVersion(),
            'contentVersion' => $object->getContentVersion(),
            'items' => $object->getItems(),
            'type' => $object->getType(),
            'createdAt' => $object->getCreatedAt(),
            'updatedAt' => $object->getUpdatedAt(),
        ];
    }
}
