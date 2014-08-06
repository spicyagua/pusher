var PT1 = PT1 || {};

PT1.app = (function() {
  var _main = function() {
    console.log("PT1 main");
    var pusher = new Pusher("34690");
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert('An event was triggered with message: ' + data.message);
    });    
  };
  return {
    main: _main
  }
}());


