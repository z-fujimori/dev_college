<html>
  <head>
    <title>2 読み上げテスト</title>
    <link rel="icon" href="data:,">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width">
  </head>
  
  <x-app-layout>
    <body>
      <input id="inputText" type="text" >
      <input type="button" value="Hello World!" onclick="say('Hello World!')">
    </body>
  </x-app-layout>

  <script src="{{asset('js/speech.js')}}"></script>
  
</html>

