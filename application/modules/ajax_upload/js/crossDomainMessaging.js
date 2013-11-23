  function sendMessage(message)
        {
            var win = parent.window;

            // http://robertnyman.com/2010/03/18/postmessage-in-html5-to-send-messages-between-windows-and-iframes/


            // http://stackoverflow.com/questions/16072902/dom-exception-12-for-window-postmessage
            // Specify origin. Should be a domain or a wildcard "*"

            if (win == null || !window['postMessage'])
                alert("your browser does not support this feature");
            else
                win.postMessage(message, "*");
            //alert("lol");
        }
		
	
		/* example receive message
        function ReceiveMessage(evt) {
            var message;
            //if (evt.origin !== "http://robertnyman.com")
            if (false) {
                message = 'Error receiving message';
            }
            else {
                message = evt.data;
            }

		
		// ajax here
		

        }
		*/





 if (!window['postMessage'])
            alert("Your browser does not support this feature");
        else {
            if (window.addEventListener) {
                //alert("standards-compliant");
                // For standards-compliant web browsers (ie9+)
                window.addEventListener("message", ReceiveMessage, false);
            }
            else {
                //alert("not standards-compliant (ie8)");
                window.attachEvent("onmessage", ReceiveMessage);
            }
        }