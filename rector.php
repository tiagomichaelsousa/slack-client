<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\DeadCode\Rector\If_\RemoveAlwaysTrueIfConditionRector;
use Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__.'/src',
    ]);

    $rectorConfig->skip([
        FinalizeClassesWithoutChildrenRector::class => [
            __DIR__.'/src/Exceptions/ErrorException.php',
            __DIR__.'/src/Testing/ClientFake.php',
        ],
        RemoveAlwaysTrueIfConditionRector::class => [
            __DIR__.'/src/ValueObjects/Transporter/Payload.php',
        ],
    ]);

    $rectorConfig->rules([
        InlineConstructorDefaultToPropertyRector::class,
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION,
        SetList::PRIVATIZATION,
    ]);
};
