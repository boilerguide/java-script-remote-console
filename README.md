# Java Script Remote Console

This is a tool created to aid testing and debugging JavaScript on mobile browsers. It contains two complementary parts - the client script and the server, using the WebSockets for maintaining connections.
### Client
Client is a simple .js file that should be included as the very first script to the website being tested. It overwrites the `window.console` object of the browser to capture all `console.*()` calls, e.g. the `console.log()`.

**Important** - the js file contains the hardcoded IP address and port number. These values should be changed before use.

### Server
Server is a set of PHP classes listening to and printing messages captured from the client. At the moment no configuration file exists so all alteration has to be done on the file level. However, it is reccomended not to change values other than IP address and port number. The config file is to be included in future versions. Server can be run with `php server/bin/run.php` command.

***
### Known issues
Trying to run on 64bit PHP under Windows, with openssl extension enabled, causes PHP warning blocking server's work.