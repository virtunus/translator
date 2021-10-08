<?php

namespace Virtunus\Translator\Facades;

use Illuminate\Support\Facades\Facade;
use Virtunus\Translator\TranslateClient;
use Virtunus\Translator\TranslateClientFake;

/**
 * @method static void assertDetectedLanguage(string $lang)
 * @method static void assertDetectedLanguageIsNot(string $lang)
 * @method static array detectLanguages(string $text, string $projectId = '', string $location = 'global')
 *
 * @see \Enzaime\DynamicLink\DynamicLink
 */
class Translator extends Facade
{
    /**
     * Replace the bound instance with a fake.
     *
     * @param  array|string  $eventsToFake
     * @return \Illuminate\Support\Testing\Fakes\EventFake
     */
    public static function fake($eventsToFake = [])
    {
        static::swap($fake = new TranslateClientFake());

        return $fake;
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return TranslateClient::class;
    }
}