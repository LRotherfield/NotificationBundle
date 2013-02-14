#Notification Bundle

This bundle provides methods for creating flash notifications and instant notifications that will rendered with
javascript to the user.  Symfony2 already has a flashBag for flash messages, this bundle builds from there to
add customisable javascript notifications using humane.js.

##Install instructions

The simplest way to install this bundle is to use composer.

Add the notification bundle as a requirement to composer.json:

```json
{
    "require":{
        "lrotherfield/notification-bundle": "dev-master"
    }
```

Update the dependecies using composer: `php composer.phar update`

Add the notification bundle to the AppKernal.php file:

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            //...
            new LRotherfield\Bundle\NotificationBundle\LRotherfieldNotificationBundle(),
```

This bundle uses a js and css file and so needs to be added to the assetic configuration in config.yml:

```yaml
# Assetic Configuration
assetic:
    #...
    bundles:        [LRotherfieldNotificationBundle]
```

Thats it, all installed.

##Simple usage

There are two main sets of functionality, adding notifications and rendering notifications.

###Adding notifications

To add a notification, use the `add()` method

```php
// any class with access to the service container
$this->container->get('lrotherfield.notify')->add("foo", array("message" => "bar"));
```

###Render notifications

There are two twig functions for rendering notifications:

`notify_all()` renders all notifications

`notify_one("foo")` renders all "foo" notifications like the one added in the above example

An argument can be given in notify_all() and notify_one() to specify the id of an element to append the message to:
```
# Append to element with id="baz"
{{ notify_all("baz") }}
# or
{{ notify_one("foo", "baz") }}
```

###Adding options

There are a number of options available when using the add() method to add a notification:

```php
//Defaults listed below
"message" => "", // The message to render, will be wrapped in p tags
"title" => "", // The title to render, will be wrapped in h2 tags
"class" => "notice", // css class to add to the notification div
"type" => "flash", // flash or instant, instant lasts until a page refresh, flash lasts for one redirect
"lifetime" => "5000", // Lifetime of the notification in ms
"click_to_close" => false, //true or false, true will make notification disappear only on click, false will use lifetime
"sticky" => false // Makes the notification sticky and not disappear
```