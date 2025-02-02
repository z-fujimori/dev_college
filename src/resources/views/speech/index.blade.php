<html>
  <head>
    <title>2 読み上げテスト</title>
    <link rel="icon" href="data:,">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width">
    <link href="/css/app.css" rel="stylesheet">
    @livewireStyles
  </head>

  <x-app-layout>
    <body>
      <div class="py-12 mx-12">
        <input id="inputText" value="こんにわ" type="text" class="font-semibold text-xl text-green-950">
        <input type="button" value="Hello World!" onclick="say(`tes`)" class="bg-success bg-green hover:bg-green-300">
      </div>
      <div>
      <livewire:counter />
      </div>
      @livewireScripts
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
  </x-app-layout>

  <script src="{{asset('js/speech.js')}}"></script>

</html>

