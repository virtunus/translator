<?php

namespace Virtunus\Translator\Tests\Unit;

use Virtunus\Translator\Facades\Translator;
use Virtunus\Translator\Tests\TestCase;
use Virtunus\Translator\TranslateClient;

class LanguageDetectorTest extends TestCase
{
    // public function tests_detect_english_lang()
    // {
    //     $client = new TranslateClient();
    //     $langs = $client->detectLanguages('May Allah bless you');
    //     $this->assertContains('en', $langs);
    // }

    // public function tests_detect_bangali_lang()
    // {
    //     $client = new TranslateClient();
    //     $langs = $client->detectLanguages('আল্লাহ তোমাকে রহমত করুক');
    //     $this->assertContains('bn', $langs);
    // }

    public function tests_faking()
    {
        Translator::fake();

        $langs = Translator::detectLanguages('May Allah bless you');

        $this->assertContains('en', $langs);
        Translator::assertDetectedLanguage('en');
        Translator::assertDetectedLanguageIsNot('bn');
    }
}
