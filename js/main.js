var PT1 = PT1 || {};

PT1.app = (function() {

  var pusher;
  var channel;

  var _main = function(userID) {
    console.log("PT1 main.  UserID: " + userID);

    Pusher.log = function(message) {
      console.log("(pusher message) " + message);
    };
    
    Pusher.channel_auth_endpoint = "presenceAuth.php";

    //Basic subscription to a public event
    pusher = new Pusher('95c1ee6cc09dfd0efb14');
    channel = pusher.subscribe('test_channel');
    channel.bind('my_event', function(data) {
      console.log(data);
      console.log("Got one: " + data.message);
    });
    
    var channel2 = pusher.subscribe('presence-channel');
    channel2.bind('pusher:subscription_succeeded', function() {
    	console.log("subscription succeeded!");
    });  
    
    channel2 .bind('pusher:subscription_error', function(status) {
    	console.log("subscription_error.  Status: " + status);
      if(status == 408 || status == 503){
        // retry?
      }
    }); 
    
    channel2 .bind('pusher:member_added', function(member) {
    	console.log("Member added: " + member.id + ", other: " + member);
    });   
    
    channel2 .bind('pusher:member_removed', function(member) {
    	console.log("Member Removed: " + member.id + ", other: " + member);
    });         
    
        
    

/*
    var pusher = new Pusher("95c1ee6cc09dfd0efb14");
    var channel = pusher.subscribe('test_channel');
    channel.bind('my-event', function(data) {
      alert('An event was triggered with message: ' + data.message);
      console.log("Got one");
    });
*/
  };
  return {
    main: _main
  }
}());