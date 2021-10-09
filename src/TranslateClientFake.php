<?php

namespace Virtunus\Translator;

use Google\Cloud\Translate\V3\TranslationServiceClient;
use PHPUnit\Framework\Assert as PHPUnit;

class TranslateClientFake
{
    protected string $detectedLang = '';

    /**
     * Get probable languages as key-value where key is the confidence and value is the language code
     *
     * @param string $text
     * @param string $projectId
     * @param string $location
     * @return array
     */
    public function detectLanguages(string $text, string $projectId = '', string $location = 'global'): array
    {
        $this->detectedLang = 'en';

        $confidence = rand(0, 10) / 10;

        return [
            "$confidence" => 'en',
        ];
    }

    /**
     * Get the client
     *
     * @return \Google\Cloud\Translate\V3\TranslationServiceClient
     */
    public function getClient()
    {
        return $this;
    }

    public function getDefaultProjectID(): string
    {
        return config('v-translator.google_project_id') ?: '';
    }

    public function __call($method, $parameters)
    {
        return $this->getClient()->$method(...$parameters);
    }

    /**
    * Assert if the detected language is the given lang.
    *
    * @param  int $count
    * @return void
    */
    public function assertDetectedLanguage(string $lang)
    {

        PHPUnit::assertSame(
            $lang,
            $this->detectedLang,
            "The actual detected language was{$this->detectedLang} times but expected $lang."
        );
    }

    /**
    * Assert if the detected language is not the given lang.
    *
    * @param  int $count
    * @return void
    */
    public function assertDetectedLanguageIsNot(string $lang)
    {
        PHPUnit::assertNotSame(
            $lang,
            $this->detectedLang,
            "The actual detected language was{$this->detectedLang} times and also expected $lang."
        );
    }
}