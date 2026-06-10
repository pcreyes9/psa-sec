@if (session()->has('success'))

    <div class="fixed top-5 right-5 z-50">
        <div class="bg-green-600 text-white px-6 py-4 rounded-2xl shadow-xl">

            <div class="font-semibold">
                Success
            </div>

            {{ session('success') }}

        </div>
    </div>

@endif

@if (session()->has('error'))

    <div class="fixed top-5 right-5 z-50">
        <div class="bg-red-600 text-white px-6 py-4 rounded-2xl shadow-xl">

            <div class="font-semibold">
                Error
            </div>

            {{ session('error') }}

        </div>
    </div>

@endif

@if (session()->has('warning'))

    <div class="fixed top-5 right-5 z-50">
        <div class="bg-yellow-600 text-white px-6 py-4 rounded-2xl shadow-xl">

            <div class="font-semibold">
                Warning
            </div>

            {{ session('warning') }}

        </div>
    </div>

@endif