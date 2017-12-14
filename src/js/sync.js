var SailthruGigya = {

  options : {},
  profile : {},

  init : function(options) {

    if (!window.Sailthru) {
      console.log('Sailthru JS is not loaded.Ensure you have included the JS on page');
      return;
    }

    if (gigya) {
        this.options = options;
        gigya.socialize.addEventHandlers({
          onLogin:this.syncProfile
       });
    } 
  },

  syncProfile : function(eventObj) {

      // Allow customer to send this to server side too for additional processing.  
      if (SailthruGigya.options.callback_url) {
        SailthruGigya.processCallback(eventObj, SailthruGigya.options.callback_url);
      }

      var userKey = '';
      var vars = {};
      var lists = {};
      var params = {};

      if (eventObj.user.email !=='' || typeof eventObj.user.email == 'undefined') {

        // default vars to exclude
        var exclude = 'UIDSig, UIDSignature, signatureTimestamp, capabilities, statusCode, statusReason, signatureTimestamp, isTempUser, isConnected, isLoggedIn, isSiteUID, isSiteUser, oldestDataUpdatedTimestamp';

        if (SailthruGigya.options.exclude_vars) {
           exclude = exclude + ',' + SailthruGigya.options.exclude_vars;
        }

        for (let key in eventObj.user) {        
          
          if (exclude.indexOf(key) < 0) {
            if (eventObj.user[key].length > 0) {
              vars[key] = eventObj.user[key];
            }
          }
        }
        // lists
        if (SailthruGigya.options.lists) {
          lists =  SailthruGigya.options.lists
        } 

        var success_message = 'Sailthru User Call Successful';
        var failure_message = 'Sailthru User Call Failed';
      
        Sailthru.integration("userSignUp",
         {
          "email" : eventObj.user.email, 
          "vars" : vars,
          "lists" : lists,
          "onSuccess" : function(){console.log(success_message)},
          "onError": function(){console.log(failure_message)},
         }
        );
      }

  }, 

  processCallback : function(profile, url) {

      var x = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
      SailthruGigya.profile = profile;
      var payload = JSON.stringify(SailthruGigya);
      var params = 'json='+payload;

      x.open("POST", url, true);
      x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      x.setRequestHeader("Content-length", params.length);
      x.setRequestHeader("Connection", "close");

      x.onreadystatechange=function()
      {
      if (x.readyState==4 && x.status==200)
        {
          sailthru_response = x.responseText;
        } else {
          sailthru_response = x.readyState;
        }
      }
      x.send(params);

  },

};