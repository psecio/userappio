## API Interface for UserApp.io

**Usage:**

This is an example of its usage with a Guzzle client instance:

```php
require_once 'vendor/autoload.php';
use Guzzle\Http\Client;

$client = new Client();

$appId = '<your app ID>';
$apiToken = '<your API token>';

$service = new \Psecio\Userappio\Service($appId, $apiToken, $client);
$result = $service->user->login('darthsidious', 'test1234');

print_r($result);
```

