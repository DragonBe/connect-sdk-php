<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

interface FieldInterface
{
    public function getPurposeType(): string;
    public function getValue(): string;
    public function isGenerate(): bool;
    public function getReceipe(): ReceipeInterface;
    public function getSection(): SectionInterface;
}
