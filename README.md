# faye-laravel-broadcaster

## This is a wrapper for https://github.com/ArnisLielturks/faye-clientt library. Intended for use in Laravel 5+ applications
### Installation
1. Install the package via composer:
 ```sh
composer require arnislielturks/faye-laravel-broadcaster
```

2. Register the provider in config/app.php
 ```php
// 'providers' => [
    ArnisLielturks\FayeBroadcaster\FayeBroadcasterProvider::class,
// ];
```

3. Add configuration file (config/faye.php) with the following content. This should point to the Faye service
```php
return [
    'server' => 'http://127.0.0.1:8000'
];
```

4. Change the broadcast driver to Faye in (config/broadcasting.php
```php
default' => env('BROADCAST_DRIVER', 'faye'),
```
OR set this value in .env file

```php
BROADCAST_DRIVER=faye
```

5. Create event which will send out the broadcast via Faye service

```php
class TestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //All public attributes will be sent with the message
    public $id;
    public $event = 'test_event';

    public function __construct()
    {
        $this->id = 123;
    }

    public function broadcastOn()
    {
        //List of channels where this event should be sent
        return ['/test_event'];
    }

}
```

6. Send out the event via Controller
```php
class TestController extends Controller
{
    public function test() {
        event(new TestEvent());
        return view('main');
    }
}
```

Outgoing message to the /test_event channel will look something like this:
```php
{ 
  id: 123,
  event: 'test_event',
  socket: null,
  event_object: 'App\\Events\\TestEvent'
}
```

That's it!
