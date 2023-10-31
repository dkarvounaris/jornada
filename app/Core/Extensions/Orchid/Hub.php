<?php

namespace Core\Extensions\Orchid;

abstract class Hub
{
    /**
     * The paths (route names only) for which should be displayed as hub.
     * Several route names, route name prefixes or route names with shell wildcards can be used.
     *
     * @var array|string[]
     */
    public static array $prefixes = [];

    /**
     * IF it should register as fallback, in case no other hub is active. Prefixes still apply.
     * @var bool
     */
    public static bool $isFallback = false;

    public function register(): void
    {
        $this->registerMenu();
    }

    /**
     * @return array|Menu[]
     */
    abstract public function buildMenu(): array/*|Menu[]*/ ;

    /**
     * @return array|string[]
     */
    public static function prefixes(): array
    {
        return self::$prefixes;
    }

    public static function isFallback(): bool
    {
        return self::$isFallback;
    }

    /**
     * A hub can override to report, that it can't be active under certain conditions other than route prefixes
     */
    public static function isSupported(): bool
    {
        return true;
    }

    /**
     * Conditionally registers the hub, when supported. Preferred, when you do not need a reference to the instance
     */
    public static function registerWhenSupported(): void
    {
        if (static::isSupported()) {
            (new static())->register();
        }
    }

    public function registerMenu(): array
    {
        return (new MenuBuilder())->build(
            ...$this->buildMenu()
        );
    }

}
