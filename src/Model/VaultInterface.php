<?php

namespace OnePassword\Connect\Model;

interface VaultInterface
{
    public function getId(): string;
    public function getName(): string;
    public function getAttributeVersion(): int;
    public function getContentVersion(): int;
    public function getItems(): int;
    public function getType(): string;
    public function getCreatedAt(): string;
    public function getUpdatedAt(): string;
}
