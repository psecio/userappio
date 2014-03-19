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

// User login
$result = $service->user->login('darthsidious', 'test1234');
print_r($result);

// User save
$result = $service->user->save(array(
	'user_id' => $result->user_id,
	'login' => 'darthsidious',
	'first_name' => 'Test'
));

// User logoff
$result = $service->user->logout();

// Set logging
$service->setLogger(new Logger())
```

