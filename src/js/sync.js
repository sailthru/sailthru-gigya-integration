var SailthruGigya = {

  sailthru_response : '',

  syncProfile : function(eventObj, callback_url) {

    // If callback enabled send to a server side when requiring User API calls
    if (callback_url.length > 0) {      

      var x = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
      var profile = SailthruGigya.serialize_profile(eventObj);
      var params = 'json='+profile;

      x.open("POST", callback_url, true);
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

    } else {
        
      if (window.Sailthru) {
        
        if ( eventObj.user.email.length <=0 || eventObj.user.email !== undefined ) {
          var vars = {};
          var lists = {};
          // default vars to exclude
          var exclude = 'UIDSig, UIDSignature, signatureTimestamp, capabilities, statusCode, statusReason, signatureTimestamp, isTempUser, isConnected, isLoggedIn, isSiteUID, isSiteUser, oldestDataUpdatedTimestamp';
          
          for (let key in eventObj.user) {        
            
            if (exclude.indexOf(key) < 0) {
              if (eventObj.user[key].length > 0) {
                vars[key] = eventObj.user[key];
              }
            }
          }

          // lists
          if (SailthruGigya.lists !== undefined) {
            var lists = SailthruGigya.lists;
          } else {
            var lists = {};
          }

          Sailthru.integration("userSignUp",
          {
            "email" : eventObj.user.email , 
            "vars" : vars,
            "lists" : lists,
            "onSuccess": function(){console.log('User Call Successful')},
            "onError": function(){console.log('User Call Unsuccessful')},
          });
        }

      } else {
        console.log('Sailthru JS is not loaded.Ensure you have included the JS on page');
      }
    }
  }, 

  // Serialize the profile to JSON
  serialize_profile: function(obj) {
    user = JSON.stringify(obj);
    return user;
  }

};

function SailthruSync(eventObj) {
  
  if (SailthruGigya.callback_url) {
    url = SailthruGigya.callback_url;
  } else {
    url = '';
  }
  SailthruGigya.syncProfile(eventObj,url);

}