<?php

namespace Virtunus\Translator;

use Google\Cloud\Translate\V3\TranslationServiceClient;

class TranslateClient
{
    /**
     * Get probable languages as key-value where key is the confidence and value is the language code
     *
     * @param  string  $text
     * @param  string  $projectId
     * @param  string  $location
     * @return array
     */
    public function detectLanguages(string $text, string $projectId = '', string $location = 'global'): array
    {
        $translationServiceClient = $this->getClient();
        $projectId = $projectId ?: $this->getDefaultProjectID();

        $formattedParent = $translationServiceClient->locationName($projectId, $location);

        // Optional. Can be "text/plain" or "text/html".
        $mimeType = 'text/plain';
        $langs = [];

        try {
            $response = $translationServiceClient->detectLanguage(
                $formattedParent,
                [
                    'content' => $text,
                    'mimeType' => $mimeType,
                ]
            );

            // Display list of detected languages sorted by detection confidence.
            // The most probable language is first.
            foreach ($response->getLanguages() as $language) {
                $langs[(string) $language->getConfidence()] = $language->getLanguageCode();
            }
        } finally {
            $translationServiceClient->close();
        }

        return $langs;
    }

    /**
     * Get the client
     *
     * @return \Google\Cloud\Translate\V3\TranslationServiceClient
     */
    public function getClient()
    {
        return new TranslationServiceClient([
            'credentialsConfig' => [
                'keyFile' => config('v-translator.google_credentials'),
            ],
        ]);
    }

    public function getDefaultProjectID(): string
    {
        return config('v-translator.google_project_id') ?: '';
    }

    public function __call($method, $parameters)
    {
        return $this->getClient()->$method(...$parameters);
    }
}
