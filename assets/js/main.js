/**
* We create the DIV dynamically to work correctly with Tag Manager
*/

"use strict";
  window.fbAsyncInit = function() {
    FB.init({
      appId: fb_messenger_ids.app_id, // Replace with your Facebook App ID
      autoLogAppEvents: true,
      xfbml: true,
      version: 'v12.0' // Use the latest version available
    });

    jQuery(document).trigger('fbload'); // Trigger the custom event 'fbload' after SDK loads
  };


(function (d, s, id) {
    "use strict";
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) { return; }
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
    js.setAttribute('crossorigin', 'anonymous'); // Add crossorigin attribute
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

