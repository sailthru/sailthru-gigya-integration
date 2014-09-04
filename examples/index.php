<?php include 'config.api.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <!-- socialize.js script should only be included once -->
  <script type="text/javascript" src="http://cdn.gigya.com/js/socialize.js?apiKey=<?php echo $gigya_api_key?>">
  {
    siteName: 'gigya.dev'
    ,enabledProviders: 'facebook,twitter, linkedin'
  }
</script>
<script src="sync.js"></script>

  <script type="text/javascript">
    SailthruGigya.callback_url = 'http://gigya.dev/gigya-callback.php';
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
