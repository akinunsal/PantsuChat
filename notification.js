window.addEventListener('load', function() {
	// Query selector
	var button = document.querySelector('#button');
	
	// Event
	button.addEventListener('click', function() {
		
		// If browser supports notifications
		if(Notification) {
			
			// If the notification is not denied
			if(Notification.permission !== "denied") {
				
				// Request permission
				Notification.requestPermission(function (status) {
				
					if (Notification.permission !== status) {
						Notification.permission = status;
					}
					
				});
				
			}
			
		}
			
	});
	
    var myMessages = ['info','warning','error','success'];
    
    function hideAllMessages() {
         var messagesHeights = new Array(); // this array will store height for each
     
         for (i=0; i<myMessages.length; i++) {
          messagesHeights[i] = $('.' + myMessages[i]).outerHeight(); // fill array
          $('.' + myMessages[i]).css('top', -messagesHeights[i]); //move element outside viewport     
         }
    }
    
    
	function theNotification() {
	    var n = new Notification("Hi!",  {
            icon: 'icon.png',
            tag: 'note',
            body: 'Pantsu ipsum dolor des amet, poi des des nyaa~~'
	    });
    }
	
    // Query selector
	var button = document.querySelector('#button');
	
	// When the button is clicked
	button.addEventListener('click', function () {
	
		// If notifications are granted show the notification
		if (Notification && Notification.permission === "granted") {
			theNotification();
		}
	
		// If they are not denied (i.e. default)
		else if (Notification && Notification.permission !== "denied") {
			
			// Request permission
			Notification.requestPermission(function (status) {
				
				// Change based on user's decision
				if (Notification.permission !== status) {
					Notification.permission = status;
				}
				
				// If it's granted show the notification
				if (status === "granted") {
					theNotification();
				}
		
				else {
					// Back up if the user's browser doesn't support notifications
				}
				
			});
		
		}
	
		else {
			// Back up if the user's browser doesn't support notifications
		}
		
	});
			
	});
    
}, 500);