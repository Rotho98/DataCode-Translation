<?php


class Translate
{


    protected string $translationLocation;

    protected string $fallbackLocation;


    /**
     * Translation constructor.
     * @param string $language
     * @param string $translationDir
     * @param string $fallbackLanguage
     */
    public function __construct(string $language, string $translationDir = './languages/', string $fallbackLanguage = "english")
    {

        $this->translationLocation = "{$translationDir}{$language}.json";
        $this->fallbackLocation = "{$translationDir}{$fallbackLanguage}.json";
        if (!file_exists($this->translationLocation)) {
            print("Translation file not found at {$this->translationLocation}");
        }
        if (!file_exists($this->fallbackLocation)) {
            print("Fallback file Translation not found at {$this->fallbackLocation}");
        }

    }

    /**
     * @param string $key
     * @return string
     */
    public function getTranslation(string $key): string
    {
        $translations = json_decode(file_get_contents($this->translationLocation), true);
        $fallbackTranslations = json_decode(file_get_contents($this->fallbackLocation), true);

        if (array_key_exists($key,$translations)) {
            return $translations[$key];
        } else if (array_key_exists($key, $fallbackTranslations)) {
            return $fallbackTranslations[$key];
        } else {
            return 'TRANSLATION_NOT_FOUND';
        }
    }

}

