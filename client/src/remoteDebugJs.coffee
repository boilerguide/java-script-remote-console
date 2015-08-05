class BrowserDetector
  systems: [
    "android"
    "windowsphone"
    "ios"
    "blackberry"
    "firefoxos"
    "webos"
    "bada"
    "tizen"
    "sailfish"
  ]
  getBrowserId: () ->
    id = bowser.name + ' v' + bowser.version

    if bowser.mobile || bowser.tablet
      for own system of @systems
        if bowser[system] is true then id = id + ' @ ' + system

    id

class RemoteConsole
  constructor: () ->
    @socket = new WebSocket 'ws://127.0.0.1:8081/'
    @browserDetector = new BrowserDetector
    @send 'HELLO', {name: @browserDetector.getBrowserId() }
  log: () ->
    @send 'LOG', arguments
  error: () ->
    @send 'ERROR', arguments
  warn: () ->
    @send 'WARN', arguments
  info: () ->
    @send 'INFO', arguments
  doSend: (type, data) ->
    @socket.send JSON.stringify {
      type: type,
      data: data
    }
    false
  send: (type, data) ->
    that = this
    setTimeout () ->
      if that.socket.readyState == 1 then that.doSend type, data else that.send type, data
    ,5

window.console = new RemoteConsole;