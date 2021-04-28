<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

interface SectionInterface
{
    public function getId(): string;
    public function getLabel(): string;
}
