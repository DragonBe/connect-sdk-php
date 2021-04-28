<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

interface UrlInterface
{
    public function getUrl(): string;
    public function isPrimary(): bool;
}
