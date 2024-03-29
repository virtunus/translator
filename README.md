# Google Translate API 
The sample code can be found:
- [Raw php sample API](https://cloud.google.com/translate/docs/samples)
- [Github repository](https://github.com/GoogleCloudPlatform/php-docs-samples/tree/8d25b48bfa2dbcd217e56ca7734b5d37ec29fb88/translate)


## Description
The purpose this package is to detect languages of a given string. If you need other functionality you may call that function by the google client.

These samples show how to use the [Google Cloud Translate API][translate-api]
from PHP.

[translate-api]: https://cloud.google.com/translate/docs/quickstart-client-libraries

### Installation
Add following code to the application's `composer.json` file

    "repositories": [
          ....
        {
            "type": "vcs",
            "url": "https://github.com/virtunus/translator.git"
        }
    ],
Now run the follwing command to add this package to your project.
```
    comoser require virtunus/translator
```
### Configurations
1.  **Enable APIs** - [Enable the Translate API](https://console.cloud.google.com/flows/enableapi?apiid=translate)
    and create a new project or select an existing project.
2.  **Download The Credentials** - Configure your project using [Application Default Credentials](https://console.cloud.google.com/apis/credentials).
    Click **Go to credentials** after enabling the APIs. Click **Create Credentials**
    and select **Service Account Credentials** and download the credentials file. Then set the path of
    this file to the environment variable `GOOGLE_APPLICATION_CREDENTIALS` using one of the following two ways:

- Set environment variable to `.env` file in your project
```
    GOOGLE_APPLICATION_CREDENTIALS=/path/to/credentials.json
```
- Set glabal environment variable in OS
```
    $ export GOOGLE_APPLICATION_CREDENTIALS=/path/to/credentials.json
```

### Uses

- Detect languages
```
    $client = new \Virtunus\Translator\TranslationClient();
    $langs = $client->detectLanguages('May Allah bless you', 'project-id');
```
> If you do not want to pass the `project-id` again and again then you should set the `GOOGLE_PROJECT_ID` environment varable in `.env` file of your project.

- Get original google client

```
    $client = new \Virtunus\Translator\TranslationClient();
    $googleClent = $client->getClient();
````

Now can call any function of the [google API](https://cloud.google.com/translate/docs/samples) client with `$googleClient`.

### Running Tests

```
    composer test
```

### Development Mode

You should set the following environment variable to disable language detection.

    ENABLE_LANGUAGE_DETECTION=false