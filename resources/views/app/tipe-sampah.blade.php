<x-app-layout>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">



            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="flex items-center justify-between px-4 py-4 bg-white dark:bg-gray-800">
                    <div class="">
                        <button data-modal-target="create-barang-modal" data-modal-toggle="create-barang-modal" class="bg-blue-500 font-semibold text-white rounded-md shadow-md px-2 py-1 flex items-center">
                            <svg width="20" height="20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="text-white mr-1"><title>plus-circle</title>
                                <path d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                            </svg>
                            Tambah Tipe Sampah
                        </button>
                    </div>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
                    </div>
                </div>

                <table class="px-4 border-b-2 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Satuan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga Satuan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i=1; $i<9; $i++)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="pl-3">
                                    <div class="text-base font-semibold">Neil Sims</div>
{{--                                    <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>--}}
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                Kg
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    Rp. 120.000
{{--                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Online--}}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <!-- Modal toggle -->
                                <a href="#" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit </a>
                            </td>
                        </tr>
                    @endfor
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="pl-3">
                                <div class="text-base font-semibold">Neil Sims</div>
                                {{--                                    <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>--}}
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            Kg
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                Rp. 120.000
                                {{--                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Online--}}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <!-- Modal toggle -->
                            <a href="#" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <nav class="px-4 py-4 flex items-center justify-between pt-4 bg-white dark:bg-gray-800" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span class="font-semibold text-gray-900 dark:text-white">1-10</span> of <span class="font-semibold text-gray-900 dark:text-white">1000</span></span>
                    <ul class="inline-flex -space-x-px text-sm h-8">
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                        </li>
                    </ul>
                </nav>

            </div>

            {{--            <div x-data="catData">--}}
            {{--                <table id="catTable">--}}
            {{--                    <thead>--}}
            {{--                    <tr>--}}
            {{--                        <th @click="sort('name')">Name</th>--}}
            {{--                        <th @click="sort('age')">Age</th>--}}
            {{--                        <th @click="sort('breed')">Breed</th>--}}
            {{--                        <th @click="sort('gender')">Gender</th>--}}
            {{--                    </tr>--}}
            {{--                    </thead>--}}
            {{--                    <tbody>--}}
            {{--                    <template x-if="!cats">--}}
            {{--                        <tr><td colspan="4"><i>Loading...</i></td></tr>--}}
            {{--                    </template>--}}
            {{--                    <template x-for="cat in pagedCats" :key="cat.id">--}}
            {{--                        <tr>--}}
            {{--                            <td x-text="cat.name"></td>--}}
            {{--                            <td x-text="cat.age"></td>--}}
            {{--                            <td x-text="cat.breed"></td>--}}
            {{--                            <td x-text="cat.gender"></td>--}}
            {{--                        </tr>--}}
            {{--                    </template>--}}
            {{--                    </tbody>--}}
            {{--                </table>--}}
            {{--                <button @click="previousPage">Previous</button> <button @click="nextPage">Next</button>--}}
            {{--            </div>--}}

        </div>
    </div>

    <!-- Create Barang -->
    <div id="create-barang-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Tipe Sampah</h3>
                    <form class="space-y-6" action="#">
                        <div>
                            <label for="create-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="create-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Plastik" required>
                        </div>
                        <div>
                            <label for="create-satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                            <input type="text" name="satuan" id="create-satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Kg" required>
                        </div>
                        <div>
                            <label for="create-harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Satuan</label>
                            <input type="text" name="harga" id="create-harga" placeholder="20000" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit user modal -->
    <div id="editUserModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editUserModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Tipe Sampah</h3>
                    <form class="space-y-6" action="#">
                        <div>
                            <label for="create-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="create-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Plastik" required>
                        </div>
                        <div>
                            <label for="create-satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                            <input type="text" name="satuan" id="create-satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Kg" required>
                        </div>
                        <div>
                            <label for="create-harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Satuan</label>
                            <input type="text" name="harga" id="create-harga" placeholder="20000" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('catData', () => ({
            cats:null,
            sortCol:null,
            sortAsc:false,
            pageSize:4,
            curPage:1,
            async init() {
                let resp = await fetch('https://www.raymondcamden.com/.netlify/functions/get-cats');
                // Add an ID value
                let data = await resp.json();
                data.forEach((d,i) => d.id = i);
                this.cats = data;
            },
            nextPage() {
                if((this.curPage * this.pageSize) < this.cats.length) this.curPage++;
            },
            previousPage() {
                if(this.curPage > 1) this.curPage--;
            },
            sort(col) {
                if(this.sortCol === col) this.sortAsc = !this.sortAsc;
                this.sortCol = col;
                this.cats.sort((a, b) => {
                    if(a[this.sortCol] < b[this.sortCol]) return this.sortAsc?1:-1;
                    if(a[this.sortCol] > b[this.sortCol]) return this.sortAsc?-1:1;
                    return 0;
                });
            },
            get pagedCats() {
                if(this.cats) {
                    return this.cats.filter((row, index) => {
                        let start = (this.curPage-1)*this.pageSize;
                        let end = this.curPage*this.pageSize;
                        if(index >= start && index < end) return true;
                    })
                } else return [];
            }
        }))
    });
</script>
