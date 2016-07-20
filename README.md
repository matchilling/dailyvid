# DailyVid Zend Playground

This is a skeleton application using the Zend Framework MVC layer and module systems. A live demo is available on a free heroku dyno under the following url [dailyvid.herokuapp.com](https://dailyvid.herokuapp.com)

## Development

```bash
// Start a local webserver
$ composer serve

Listening on http://0.0.0.0:8080
Document root is /public
Press Ctrl-C to quit.
```

## Deployment

A push to the `master` branch will trigger an event which initiates a webhook call to heroku. The dyno picks the message up and will redploy the application automatically.
