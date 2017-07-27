# Google Analytics without setting a cookie

[![Build Status](https://travis-ci.org/barryceelen/wp-analytics-without-cookies.svg?branch=master)](https://travis-ci.org/barryceelen/wp-analytics-without-cookies)

Uses the [fingerprint2.js](https://github.com/Valve/fingerprintjs2) script to try and create a more or less unique identifier for a visitor. This will reduce the accuracy of your metrics as opposed to using Google's own methods, which may or may not be good enough for your tracking purposes.

Upside is that no tracking cookies are created which is nice if you are concerned about showing a cookie consent warning for your tracking script.
Tracking *is* harmless, right?

It does add about 30KB page weight for the fingerprint2.js script, which you may or may not like.

### Setting your analytics tracking ID

There is no settings page for this plugin. Set your own tracking id by adding a filter:

```
add_filter( 'analytics_without_cookies_tracking_id', function() { return 'UA-XXXXXXX-XX'; } );
```

### Your visitor's IP adresses are anonymized by default

Turn IP anonymization off if you are so inclined:

```
add_filter( 'analytics_without_cookies_anonymize_ip', '__return_true' );
```

### Logged in users are not tracked by default

Track logged in users:

```
add_filter( 'analytics_without_cookies_ignore_logged_in_users', '__return_false' );
```

