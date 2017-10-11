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

   SailthruGigya.init({
    "lists" : {'List1' : 1, 'list2': 0, 'list3': 1},
    "exclude_vars" : []
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
