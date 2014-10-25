#Monocfg

[Seldaek/Monolog] wrapper to configure handlers with json files.

##Install

Add to **composer.json**:

```sh
"repositories": [
   {
     "type": "git",
     "url": "git://github.com/eugeneset/logger.git"
   }
]
```

execute

```sh
composer install --no-dev
```

##Usage

```php
<?php

require '../vendor/autoload.php';

use Monocfg\Logger;
use Monocfg\Settings;

$logger = new Logger('testlog', new Settings('config.json'));
$logger->addInfo('test');
```
######config.json
```
{
    "StreamHandler" : [
        "logs/simple.log"
    ],
    "NativeMailerHandler" : [
        "user@email.com",
        "Project logger",
        "test@email.com",
        "400"
    ],
    "LogEntriesHandler" : [
        "2f5aeb4b-8be5-4a1e-bc78-38b4a4e6c570",
        "false"
    ],
    "NewRelicHandler" : [
        "200",
        "false",
        "project-prod",
        "true"
    ]
}
```
Handlers signatures should be compatible with [native] [seldaek/monolog/sources].

[seldaek/monolog]:https://github.com/Seldaek/monolog
[seldaek/monolog/sources]:https://github.com/Seldaek/monolog/tree/master/src/Monolog/Handler