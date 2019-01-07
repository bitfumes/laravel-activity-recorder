# Activity Recorder

## Install

`composer require bitfumes/laravel-activity-recorder`

## Usage

This package record model events in activities table in your database.

### Using Trait

```php
use Illuminate\Database\Eloquent\Model;
use Bitfumes\Activity\Traits\RecordActivity;

class Item extends Model
{
    use RecordActivity;
}
```

### Activity To Record

If you does't specify, then it will record only created model event.

_Record other activities_
just need to specify a static variable in your model to track other model events also.

```php
class Item extends Model
{
    use RecordActivity;

    protected static $eventsToRecord = ['created','deleted'];
}
```

Now this will also going to record `deleted` event of that model.

## Testing

Run the tests with:

```bash
vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email sarthak@bitfumes.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
