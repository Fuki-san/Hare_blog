{{-- //渡されたパラメータを使う宣言。 --}}
@props(['message'])
@if ($message)
    <div class="bg-blue-100 border-blue-500 text-blue-700 border1-4 p-4 my-2">
        {{ $message }}
    </div>
@endif

{{-- @if (session('notice'))
下記のコードでリファクタリングをし、propsを書いたと、if文の引数などをmessageにする(index.php,show.phpなどの<x-flash-message :message="session('notice')" />これで定義したやつ)
    <div class="bg-blue-100 border-blue-500 text-blue-700 border1-4 p-4 my-2">
        {{ session('notice') }}
    </div>
@endif --}}
