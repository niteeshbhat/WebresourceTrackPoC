The application loads the track.xml.

Decoder extracts init webpage, saves it in blob and passes the blob url to the application.

The application loads the init page from blob in a new window.

Decoder extracts other samples according to the decode duration and sends them to the new window using postmessage.

The init page has a script which listens to the message which is being sent using postmessage.