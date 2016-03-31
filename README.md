Integrating Gigya's Social Login with Sailthru
==========================

For full instructions on how to implement the integration please visit http://docs.sailthru.com/integration/gigya

#### What this repository includes

#### Libraries
The src folder contains libraries for PHP and Ruby

#### Examples
The examples folder contains the framework to get your own integration up and running with PHP.

To get started you'll need to have an account with Gigya and have your Gigya API key and Secret and also your Sailthru
API Key and secret.

Once you have the necessary keys create a file in the examples folder called config.api.php with the following variables updated to match the appropriate keys and secrets from your Sailthru and Gigya accounts.

```
<?php

$api_key = '';
$api_secret = '';
$gigya_api_key = '';
$gigya_secret_key = '';

```

### Callback URL

The customer will need to create an script on their server to capture the callback url described below and make a User API call. The snippet below outlines how to call the Sailthru JS.

```
<script src="https://ak.sail-horizon.com/gigya/sync.js"></script>

  <script type="text/javascript">
    SailthruGigya.callback_url = 'http://customerdomain.com/gigya-callback';
    gigya.socialize.addEventHandlers({
        onLogin:SailthruSync
    });
  </script>
```

