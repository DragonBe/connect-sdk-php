<?php

namespace OnePassword\Connect\Model;

class VaultHydrator implements HydratorInterface
{

    public function hydrate(object $object, array $data): object
    {
        return new Vault(
            $data['id'],
            $data['name'],
            $data['attributeVersion'],
            $data['contentVersion'],
            $data['items'],
            $data['type'],
            $data['createdAt'],
            $data['updatedAt']
        );
    }

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
