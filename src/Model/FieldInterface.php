<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

interface FieldInterface
{
    public function getId(): string;
    public function getPurpose(): string;
    public function getType(): string;
    public function getLabel(): string;
    public function getValue(): string;
    public function getEntropy(): float;
    public function isGenerate(): bool;
    public function getReceipe(): ?ReceipeInterface;
    public function getSection(): ?SectionInterface;
}
