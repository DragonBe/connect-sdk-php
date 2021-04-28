<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

use Iterator;

interface ItemInterface
{
    public function getId(): string;
    public function getTitle(): string;
    public function getVault(): ?VaultInterface;
    public function getCategory(): string;
    public function getFields(): ?Iterator;
    public function getUrls(): ?Iterator;
    public function isFavourite(): bool;
    public function getTags(): array;
    public function getVersion(): int;
    public function isTrashed(): bool;
    public function getCreatedAt(): string;
    public function getUpdatedAt(): string;
    public function getLastEditedBy(): string;
}
