<div id="{{ $id }}" class="modal transition duration-300 invisible ease-in-out opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-[90]">
    <div id="{{ 'overlay-' . $id }}" class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container rounded-lg bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-[100] overflow-y-auto">
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
            <form class="space-y-6" method="post" action="{{ route($route) }}">
                @csrf

                {{ $slot }}

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </div>
</div>
