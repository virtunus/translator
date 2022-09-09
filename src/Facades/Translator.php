<?php

namespace Virtunus\Translator\Facades;

use Illuminate\Support\Facades\Facade;
use Virtunus\Translator\FakeClient;
use Virtunus\Translator\TranslationClient;

/**
 * @method static void assertDetectedLanguage(string $lang)
 * @method static void assertDetectedLanguageIsNot(string $lang)
 * @method static array detectLanguages(string $text, string $projectId = '', string $location = 'global')
 * @method static \Google\Cloud\Translate\V3\TranslationServiceClient getClient()
 *
 * @see \Virtunus\Translator\TranslateClient
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
        static::swap($fake = new FakeClient());

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
        if (config('v-translator.enable_language_detection') == false) {
            return FakeClient::class;
        }

        return TranslationClient::class;
    }
}
