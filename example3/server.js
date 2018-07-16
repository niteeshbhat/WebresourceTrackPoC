//The WebSocket server program
//Runs on port 8080
const  WebSocket  = require('ws');

const  wss  =  new  WebSocket.Server({ port: 8080 });

var receivedMsg;
//WS connection opened
wss.on('connection', function connection(ws) {
    
  //The samples sent by the application is received at the server.  
  ws.on('message', function incoming(message) {
    //console.log('received: %s', message);
    receivedMsg=message;
  });

  //The received sample is forwarded to the browser when connected to the server.
  ws.send(receivedMsg);
  //console.log('sent: %s', receivedMsg);
});