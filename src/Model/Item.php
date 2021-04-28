<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

use Iterator;

class Item implements ItemInterface
{
    private string $id;
    private string $title;
    private ?VaultInterface $vault;
    private string $category;
    private ?Iterator $fields;
    private ?Iterator $urls;
    private bool $favourite;
    private array $tags;
    private int $version;
    private bool $trashed;
    private string $createdAt;
    private string $updatedAt;
    private string $lastEditedBy;

    /**
     * Item constructor.
     * @param string $id
     * @param string $title
     * @param string $category
     * @param bool $favourite
     * @param array $tags
     * @param int $version
     * @param bool $trashed
     * @param string $createdAt
     * @param string $updatedAt
     * @param string $lastEditedBy
     * @param VaultInterface|null $vault
     * @param Iterator|null $fields;
     * @param Iterator|null $urls
     */
    public function __construct(
        string $id = '',
        string $title = '',
        string $category = '',
        bool $favourite = false,
        array $tags = [],
        int $version = 0,
        bool $trashed = false,
        string $createdAt = '',
        string $updatedAt = '',
        string $lastEditedBy = '',
        ?VaultInterface $vault = null,
        ?Iterator $fields = null,
        ?Iterator $urls = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->favourite = $favourite;
        $this->tags = $tags;
        $this->version = $version;
        $this->trashed = $trashed;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->lastEditedBy = $lastEditedBy;
        $this->vault = $vault;
        $this->fields = $fields;
        $this->urls = $urls;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return VaultInterface|null
     */
    public function getVault(): ?VaultInterface
    {
        return $this->vault;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return Iterator|null
     */
    public function getFields(): ?Iterator
    {
        return $this->fields;
    }

    /**
     * @return Iterator|null
     */
    public function getUrls(): ?Iterator
    {
        return $this->urls;
    }

    /**
     * @return bool
     */
    public function isFavourite(): bool
    {
        return $this->favourite;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @return bool
     */
    public function isTrashed(): bool
    {
        return $this->trashed;
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

    /**
     * @return string
     */
    public function getLastEditedBy(): string
    {
        return $this->lastEditedBy;
    }
}
