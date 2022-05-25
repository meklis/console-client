# Console-Client
PHP library for login/password connections to devices over Telnet and SSH.


## Example 
**SSH connection to ZTE devices**
```php
require __DIR__ . '/vendor/autoload.php';

$ssh = new \Meklis\Network\Console\SSH();
$ssh->setDeviceHelper(new \Meklis\Network\Console\Helpers\ZTE());
$ssh->connect("10.0.0.2", 2222); //Ip and custom port 
$ssh->login("login", "password"); 
echo $ssh->exec("show card");
```    

**Telnet connection to Dlink device** 
```php
require __DIR__ . '/vendor/autoload.php';

$ssh = new \Meklis\Network\Console\Telnet();
$ssh->setDeviceHelper(new \Meklis\Network\Console\Helpers\Dlink());
$ssh->connect("10.0.0.1");
$ssh->login("login", "password");
echo $ssh->exec("show switch");
```

## Supported vendors
* Alaxala 
* Bdcom   
* Cdata  
* Dlink
* Ios
* ZTE
* Junos
* Linux
* Xos   

For adding own vendors you can create Helper extended from DefaultHelper and implement HelperInterface.    
### Example of helper
```php
namespace Meklis\Network\Console\Helpers;

class Cdata extends DefaultHelper
{
    protected $prompt = 'OLT(.*?)[>#]';
    protected $userPrompt = 'ame:';
    protected $passwordPrompt = 'ord:';
    protected $afterLoginCommands = [];
    protected $beforeLogoutCommands = [];
    protected $windowSize = null;

    public function isDoubleLoginPrompt(): bool
    {
        if ($this->connectionType === 'ssh') {
            return true;
        }
        return $this->doubleLoginPrompt;
    }
}
```   

