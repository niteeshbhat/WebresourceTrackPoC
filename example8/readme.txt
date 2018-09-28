The application loads the track.xml.

Decoder extracts init webpage, saves it in blob and passes the blob url to the application.

The application loads the init page from blob in a new window.

Decoder extracts other samples and saves them in localStorage.

The init page has a script which loads  the samples from localStorage depending on the decode durations.