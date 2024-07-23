<html>
  <head>
    <title>2 読み上げテスト</title>
    <link rel="icon" href="data:,">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width">
    <link href="/css/app.css" rel="stylesheet">
  </head>
  
  <x-app-layout>
    <body>
      <div class="py-12 mx-12">
        <input id="inputText" value="こんにわ" type="text" class="font-semibold text-xl text-green-950">
        <input type="button" value="Hello World!" onclick="say(`tes`)" class="bg-success bg-green hover:bg-green-300">
      </div>
    </body>
  </x-app-layout>

  <script src="{{asset('js/speech.js')}}"></script>
  
</html>

