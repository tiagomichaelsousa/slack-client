<?php

declare(strict_types=1);

namespace Slack\Testing\Responses\Concerns;

trait Fakeable
{
    /**
     * @param  mixed[]  $override
     */
    public static function fake(array $override = []): static
    {
        $class = str_replace('Responses\\', 'Testing\\Responses\\Fixtures\\', static::class).'Fixture';

        return static::from(
            /** @phpstan-ignore-next-line **/
            self::buildAttributes($class::ATTRIBUTES, $override)
        );
    }

    /**
     * @return mixed[]
     */
    /** @phpstan-ignore-next-line **/
    private static function buildAttributes(array $original, array $override): array
    {
        $new = [];

        foreach ($original as $key => $entry) {
            $new[$key] = is_array($entry) ?
                self::buildAttributes($entry, $override[$key] ?? []) :
                $override[$key] ?? $entry;
        }

        return $new;
    }
}
