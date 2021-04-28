<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

class Vault implements VaultInterface
{
    private string $id;
    private string $name;
    private int $attributeVersion;
    private int $contentVersion;
    private int $items;
    private string $type;
    private string $createdAt;
    private string $updatedAt;

    /**
     * Vault constructor.
     * @param string $id
     * @param string $name
     * @param int $attributeVersion
     * @param int $contentVersion
     * @param int $items
     * @param string $type
     * @param string $createdAt
     * @param string $updatedAt
     */
    public function __construct(
        string $id = '',
        string $name = '',
        int $attributeVersion = 0,
        int $contentVersion = 0,
        int $items = 0,
        string $type = '',
        string $createdAt = '',
        string $updatedAt = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->attributeVersion = $attributeVersion;
        $this->contentVersion = $contentVersion;
        $this->items = $items;
        $this->type = $type;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAttributeVersion(): int
    {
        return $this->attributeVersion;
    }

    /**
     * @return int
     */
    public function getContentVersion(): int
    {
        return $this->contentVersion;
    }

    /**
     * @return int
     */
    public function getItems(): int
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
