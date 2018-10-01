The application loads the track.xml.

Decoder extracts init webpage and passes it to the application.

The application creates blob for the init page and open it in a new window.
Once the new window is ready, the decoder is called to extract other samples and sends them to the new window using postmessage.

The init page loaded in a new window has a script which listens to the message which is being sent using postmessage and caches them.
The events cached are triggered at their start times.