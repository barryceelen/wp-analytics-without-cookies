# Google Analytics without setting a cookie

Uses the [fingerprint2.js](https://github.com/Valve/fingerprintjs2) script to try and create a more or less unique identifier for a visitor. This may however reduce the accuracy of your metrics as opposed to using Google's own methods, which may or may not be good enough for your tracking purposes.

Upside is that no tracking cookies are created which is nice if you are concerned about showing a cookie consent warning for your tracking script.  
Tracking *is* harmless, right?

It does add about 30KB page weight for the fingerprint2.js script, which you may or may not like. Oh, and it requires jQuery.

###Setting your analytics tracking ID

There is no settings page for this plugin. Set your own tracking id by adding a filter:

```
add_filter( 'analytics_without_cookies_tracking_id', function() { return 'UA-XXXXXXX-XX'; } );
```

###Your visitor's IPs are anonymized by default

Turn it off if you are so inclined:

```
add_filter( 'analytics_without_cookies_anonymize_ip', '__return_true' );
```

