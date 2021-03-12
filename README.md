# MSG.ge integration for Laravel
The package for sending SMS messages using [MSG.ge](https://smsservice.ge/) API.

## Installation
```bash
composer require zsardarov/laravel-msg
```
You can publish config using:

```bash
php artisan vendor:publish --provider="Zsardarov\Msg\MsgServiceProvider"
```

### Update the `.env` file
`MSG_ALTERNATIVE_PASSWORD` is optional.

```dotenv
MSG_SERVICE_ID=1
MSG_CLIENT_ID=1
MSG_PASSWORD=password
MSG_USERNAME=user
MSG_ALTERNATIVE_PASSWORD=
```

## Usage

```php
use Zsardarov\Msg\MsgService;
use Zsardarov\Msg\Enums\GatewayStatus;
use Zsardarov\Msg\Enums\DeliveryStatus;

class SampleController extends Controller
{
    public function sms(MsgService $sender)
    {        
        $result = $sender->send('9955XXXXXXXX', 'Text');
        
        if ($result->getStatusCode() === GatewayStatus::ACCEPTED) {
            // now we can check status
            $status = $sender->status($result->getMessageId());
            
            if ($status === DeliveryStatus::PENDING || $status === DeliveryStatus::SENT) {
                // message has been sent
            }
        }
    }
}
```

## Notifications
To use it with Laravel notifications, you firstly must add `toMsg()` method in `User` model:
```php

class User extends Authenticatable
{
    use Notifiable; 
    
    public function toMsg()
    {
        return $this->mobile;
    }
}
```
Create notification:

```bash
php artisan make:notification SmsNotification
```

```php
use Illuminate\Notifications\Notification;
use Zsardarov\Msg\Channels\MsgChannel;

class SmsNotification extends Notification
{
    private $message;
    
    public function __construct(string $message) 
    {
        $this->message = $message;
    }
    
    public function via($notifiable)
    {
        return [MsgChannel::class];
    }
    
    public function toSms()
    {
        return $this->message;
    }
}
```

Then send notification to user:

```php
$user->notify(new SmsNotification('Sample'));
```
