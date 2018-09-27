The application loads the track.xml and stores in a blob which is passed to decoder.
Decoder extracts init webpage and passes to the application.

The application loads the init page to a new window (using blob).

Decoder extracts other samples according to the decode time and sends them to the new window using postmessage.


The init page has a script which listens to the message which is being sent using postmessage.
