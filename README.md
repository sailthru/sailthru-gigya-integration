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

## Client Side Integration
The client side integration use Sailthru's Javascript Tag and UserSignUp function to capture the Gigya onLogin event and pass to Sailthru. 

The customer must use Sailthru's latest Javascript Tag setup with their customer Id. 

```
<script src="https://ak.sail-horizon.com/spm/spm.v1.min.js"></script>
<script>Sailthru.init({ customerId: <insert customer id> });</script>
 ```

The script will automatically add the user profile data from Gigya's user object to the Sailthru profile. If customers wish to also add the user to a list so that they can take
advantage of Lifecycle Optimizer then they can add the following line of code before the Gigya onLogin handler. The list name with a value of 1 will add th euser to the list. 

```
<script type="text/javascript">
    SailthruGigya.lists = {"test" : 1 };
    gigya.socialize.addEventHandlers({
        onLogin:SailthruSync
    });
  </script>
```


To add a user to multiple lists configure the lists with a 1 to add the user and 0 to remove the user from the list. 

```
<script type="text/javascript">
    SailthruGigya.lists = {"test" : 0 };
    gigya.socialize.addEventHandlers({
        onLogin:SailthruSync
    });
  </script>
```

To combine a list addition and removal you can combine both params. 
```
<script type="text/javascript">
    SailthruGigya.lists = {"test" : 0, "test2" : 1 };
    gigya.socialize.addEventHandlers({
        onLogin:SailthruSync
    });
  </script>
```

### Server Side Processing

For more advanced useage of the Gigya integration the customer can create a script on their server to process the callback using an existing Sailthru client library. We currently support PHP and Ruby libraries which can be found in the src folder. 

The customer will need to create an script on their server to capture the callback url described below and make a User API call. The snippet below outlines how to call the Sailthru JS.

```
<script type="text/javascript">
    SailthruGigya.callback_url = 'http://gigya.dev/gigya-callback.php';
    gigya.socialize.addEventHandlers({
        onLogin:SailthruSync
    });
  </script>
```

The addition of the callback URL will disable the client side call. 
