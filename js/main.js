var PT1 = PT1 || {};

PT1.app = (function() {

  var pusher;
  var channel;

  var _main = function() {
    console.log("PT1 main");

    Pusher.log = function(message) {
      console.log(message);
    };

    pusher = new Pusher('95c1ee6cc09dfd0efb14');
    channel = pusher.subscribe('test_channel');
    channel.bind('my_event', function(data) {
      console.log(data);
      console.log("Got one: " + data.message);
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


