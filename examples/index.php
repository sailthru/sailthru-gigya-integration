<?php 
// Add your Gigya API key here. 
include 'config.api.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <!-- 
    Update the customerId with your Sailthru customer Id
  -->
  <script src="https://ak.sail-horizon.com/spm/spm.v1.min.js"></script>
  <script>Sailthru.init({ customerId: '' });</script>
  <!-- socialize.js script should only be included once -->
  <script type="text/javascript" src="http://cdn.gigya.com/js/socialize.js?apiKey=<?php echo $gigya_api_key?>">
  {
    siteName: 'gigya.dev'
    ,enabledProviders: 'facebook,twitter, linkedin'
  }
</script>
<script src="../src/js/sync.js"></script>

  <script type="text/javascript">

    
    /**
     Add key value pairs for every list name. If adding the user to a list set the value to 1. 
     If removing the user from a list set the value to 0. 
     
     This will add a user to the list test
     SailthruGigya.lists = {"test" : 1}; 

     This will remove the user from the list test
     SailthruGigya.lists = {"test" : 0}; 

     You can combine lists. 
     SailthruGigya.lists = {"test" : 0, "test2" : 1}; 
     **/
    SailthruGigya.lists = {"test" : 1 };

    /**
      Uncommment line below and add url to server side script if 
      implementing with the User API. An example handler is available in gigya-callback.php
      See the docs at http://docs.sailthru.com/integration/gigya for full details. 
    **/

    //SailthruGigya.callback_url = 'http://gigya.dev/gigya-callback.php';

    gigya.socialize.addEventHandlers({
        onLogin:SailthruSync
    });
  </script>
  </head>

  <body>
     <script type="text/javascript">
      var login_params=
      {
        showTermsLink: 'false'
        ,height: 100
        ,width: 330
        ,containerID: 'componentDiv'
        ,buttonsStyle: 'fullLogo'
        ,autoDetectUserProviders: ''
        ,facepilePosition: 'none'
      }
      </script>
      <div id="componentDiv"></div>
      <script type="text/javascript">
         gigya.socialize.showLoginUI(login_params);
      </script>
  </body>
</html>
