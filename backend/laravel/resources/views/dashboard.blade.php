<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!<br>
                    おかえりなさい <?php $user = Auth::user(); ?>{{ $user->name }}<br><br>
                    ログアウトすると、AuthenticateSessionController::destroy()の処理にしたがってホーム画面に戻ります。<br>
                    <br><br>
                    <a href="/page_cert">認証の説明ページへ戻る</a><br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
