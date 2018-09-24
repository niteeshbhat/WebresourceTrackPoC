The application loads the track.xml and stores in a blob which is passed to decoder.
Decoder extracts init webpage and passes to the application.
Decoder extracts other samples according to the decode time and stores them in localstorage with respective sample names.

The application loads the init page to a new window (using document.write).
The init page has a script which loads the samples from localstorage following the decode time.
