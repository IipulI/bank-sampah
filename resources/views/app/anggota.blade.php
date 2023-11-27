<x-app-layout xmlns:x-slot="http://www.w3.org/1999/xlink">

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <!-- Content -->
            <div x-data="listSampah" class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <!-- Head Table -->
                <div class="flex items-center justify-between px-4 py-4 bg-white dark:bg-gray-800">
                    <!-- Add Item -->
                    <div class="text-sm">
                        <button class="bg-blue-500 font-semibold text-white rounded-md shadow-lg px-2 py-2 flex items-center focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 transition-all" onclick="toggleModal('tambah-anggota-modal')">
                            <svg width="20" height="20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="text-white mr-1"><title>plus-circle</title>
                                <path d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                            </svg>
                            Tambah Masyarakat
                        </button>
                    </div>

                    <!-- Search Item -->
                    <div class="text-sm w-2/6">
                        <label for="search-input" class="sr-only">Search</label>
                        <div class="relative flex rounded-md shadow-sm">
                            <input id="search-input" type="search"  name="query" x-on:keyup.enter="searchSubmit" x-on:input="searchInput"
                                   class="py-2 px-4 pl-11 block w-full border-gray-200 shadow-sm rounded-l-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Cari nama masyarakat atau nik">
                            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-20 pl-4">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </div>
                            <button id="search-submit" x-on:click="searchSubmit" type="submit" class="py-2 px-4 inline-flex flex-shrink-0 justify-center items-center rounded-r-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:z-10 focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 transition-all text-sm">Search</button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div>
                    <table id="sampahTable" class="px-4 border-b-2 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nik
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tabungan
                            </th>
                            <th scope="col" class="max-w-md px-6 py-3">
                                Alamat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Telephone
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-if="!items">
                            <template x-for="1 in 10">
                                <tr class="animate-pulse">
                                    <th>
                                        <div class="mx-6 my-5 py-2 w-2/4 h-2 bg-slate-400 rounded-lg"></div>
                                    </th>
                                    <td>
                                        <div class="mx-4 my-5 py-2 w-2/4 h-2 bg-slate-400 rounded-lg"></div>
                                    </td>
                                    <td>
                                        <div class="mx-4 my-5 py-2 w-2/4 h-2 bg-slate-400 rounded-lg"></div>
                                    </td>
                                    <td>
                                        <div class="mx-4 my-5 py-2 w-2/4 h-2 bg-slate-400 rounded-lg"></div>
                                    </td>
                                    <td>
                                        <div class="mx-4 my-5 py-2 w-2/4 h-2 bg-slate-400 rounded-lg"></div>
                                    </td>
                                    <td>
                                        <div class="mx-4 my-5 py-2 w-2/4 h-2 bg-slate-400 rounded-lg"></div>
                                    </td>
                                </tr>
                            </template>
                        </template><template x-if="items?.length === 0">
                            <tr aria-label="table-row" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 text-gray-900 font-semibold text-lg text-center" colspan="5">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                        </template>
                        <template x-for="anggota in items" x-cloak>
                            <tr aria-label="table-row" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                :class="!items ? 'hidden' : ''">
                                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold" x-text="anggota.nama">Neil Sims</div>
                                        <div class="font-normal text-gray-500" x-text="anggota?.user?.email">neil.sims@flowbite.com</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4" x-text="anggota.no_nik">
                                </td>
                                <td class="px-6 py-4 max-w-[75px] text-ellipsis overflow-hidden" x-text="anggota.tabungan != null ? anggota.tabungan.jumlah_uang : 0">
                                </td>
                                <td class="px-6 py-4 max-w-md text-ellipsis overflow-hidden" x-text="anggota.alamat">
                                </td>
                                <td class="px-6 py-4" x-text="anggota.nomor_telepon">
                                </td>
                                <td class="px-6 py-4">
                                    <!-- Modal toggle -->
                                    <button href="#" @click="selectItem" onclick="toggleModal('edit-anggota-modal')" :id="anggota.no_nik" class="mr-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                    <button href="#" @click="detailAnggota" :id="'detail-' + anggota.no_nik" class="mx-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</button>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>

                    <!-- Navigation -->
                    <div class="bg-white">
                        <div class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
                            <nav class="flex items-center justify-center border-t border-gray-200 px-4 sm:px-0">
                                <div class=" flex w-0 flex-1">
                                    <button id="previous" @click="previousPage" class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 pb-2 text-sm font-medium text-gray-600 hover:text-gray-400 hover:border-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="mr-3 h-5 w-5 text-gray-600">
                                            <path fill-rule="evenodd" d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z" clip-rule="evenodd"></path>
                                        </svg>Previous
                                    </button>
                                </div>
                                <div class="hidden lg:flex">
                                    <template x-for="page in navItems" x-cloak>
                                        <input
                                            type="button" :id="page.id" x-text="page.text" x-on:click="changeInput" x-on:blur="changeButton" @keyup.enter="jumpTo" x-bind:value="page.value"
                                            :class="[ (page.value !== curPage ? 'border-transparent text-gray-600 hover:border-gray-400 hover:text-gray-400 focus:text-gray-600' : ''), (page.value === curPage ? 'text-blue-600 border-blue-600' : ''), (navItems != null ? '' : 'hidden')]"
                                            class="inline-flex items-center border-t-2 px-4 pt-4 pb-2 text-sm font-medium hover:cursor-pointer">
                                        </input>
                                    </template>
                                </div>
                                <div class=" flex w-0 flex-1 justify-end">
                                    <button id="next" @click="nextPage" class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 pb-2 text-sm font-medium text-gray-600 hover:text-gray-400 hover:border-gray-400">Next
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="ml-3 h-5 w-5 text-gray-600">
                                            <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if( \Illuminate\Support\Facades\Session::has('type') )
    <x-error-modal>
        @if(\Illuminate\Support\Facades\Session::get('type') == 'error')
            <x-slot:color>
                bg-red-100
            </x-slot:color>
            <x-slot:colortext>
                text-red-600
            </x-slot:colortext>
            <x-slot:svg>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
            </x-slot:svg>
        @endif
        @if(\Illuminate\Support\Facades\Session::get('type') == 'success')
            <x-slot:color>
                bg-green-100
            </x-slot:color>
            <x-slot:colortext>
                text-green-600
            </x-slot:colortext>
            <x-slot:svg>
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
            </x-slot:svg>
        @endif

        <x-slot:title>
            {{ \Illuminate\Support\Facades\Session::get('title') }}
        </x-slot:title>
        <x-slot:message>
            {{ \Illuminate\Support\Facades\Session::get('message') }}
        </x-slot:message>
    </x-error-modal>
    @endif

    <!-- Edit Item Sampah Modal -->
    <x-forms.input id="edit-anggota-modal" route="anggota.edit-data">
        <x-slot:title>
            Edit Anggota
        </x-slot:title>

        <div class="hidden">
            <label for="edit-id" class="hidden">Id</label>
            <input type="text" name="id" id="edit-id" class="hidden">

            <label for="edit-old-email" class="hidden">Id</label>
            <input type="text" name="old_email" id="edit-old-email" class="hidden">
        </div>
        <div>
            <label for="edit-nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input type="text" name="nama" id="edit-nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>
        <div>
            <label for="edit-satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" name="email" id="edit-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>
        <div>
            <label for="edit-nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Nik</label>
            <input type="text" name="no_nik" id="edit-nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>
        <div>
            <label for="edit-alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <textarea type="text" name="alamat" id="edit-alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" rows="3" required></textarea>
        </div>
        <div>
            <label for="edit-telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telephone</label>
            <input type="text" name="nomor_telepon" id="edit-telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>

    </x-forms.input>

    <!-- Create Item Sampah Modal -->
    <x-forms.input id="tambah-anggota-modal" route="anggota.submit-data">
        <x-slot:title>
            Tambah Anggota
        </x-slot:title>

        <div>
            <label for="tambah-nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input type="text" name="nama" id="tambah-nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>
        <div>
            <label for="tambah-satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" name="email" id="tambah-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>
        <div>
            <label for="tambah-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="pasword" id="tambah-password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>
        <div>
            <label for="tambah-nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Nik</label>
            <input type="text" name="no_nik" id="tambah-nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>
        <div>
            <label for="tambah-alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <textarea type="text" name="alamat" id="tambah-alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" rows="3" required></textarea>
        </div>
        <div>
            <label for="tambah-telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telephone</label>
            <input type="text" name="nomor_telepon" id="tambah-telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>

    </x-forms.input>

</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('listSampah', () => ({
            items:null,
            selectedItem: null,
            curPage : 1,
            lastPage : null,
            navItems : null,
            async init() {
                let resp = await fetch('http://localhost:8080/masyarakat/data');
                const listItems = await resp.json();

                this.items = listItems.data
                this.lastPage = listItems.last_page

                let modal = document.querySelectorAll('.modal')
                for(var i=0; i < modal.length; i++){
                    modal[i].classList.remove('invisible')
                }

                const nextButton = document.getElementById('next')
                const previousButton = document.getElementById('previous').value = this.curPage
                if (nextButton.value < listItems.last_page){
                    nextButton.value = this.curPage + 1
                }

                var wahey = [];
                var m = 1;
                var n = 0;
                if (this.lastPage <= 5){
                    for (n; n < this.lastPage; n++){
                        wahey[n] = { 'id': "page-"+m, 'value': m, 'text': m}
                        m++
                    }
                }
                if(this.lastPage > 5){
                    for (n; n < 3; n++){
                        wahey[n] = { 'id': 'page-'+m, 'value':m, 'text':m }
                        m++
                    }

                    if (m === 4){
                        wahey[n] = {'id' : 'page-'+m,  'value':'...', 'text':'...'}
                        m++
                        n++
                    }

                    wahey[n] = { 'id':'page-'+this.lastPage, 'value':this.lastPage, 'text':this.lastPage }
                }

                this.navItems = wahey
            },

            searchInput(e){
                const tag = document.getElementById('search-input')

                tag.addEventListener('input', function (){
                    tag.setAttribute('value', tag.value)
                })
            },

            detailAnggota(e){
                const elem = e.target
                const oid = elem.getAttribute('id')
                const id = Number(oid.slice(7))


                let searchedItem = this.items.find(o => Number(o.no_nik) === id);

                window.location.href = "http://localhost:8080/masyarakat/detail?nik=" + searchedItem.no_nik;
            },

            async searchSubmit(e){
                this.navItems = null
                this.items = null
                this.lastPage = null
                this.curPage = 1

                const input = document.getElementById('search-input')
                const value = input.value

                let resp = await fetch('http://localhost:8080/masyarakat/data?search=' + value);
                const listItems = await resp.json();

                this.lastPage = listItems.last_page
                this.items = listItems.data

                this.updateNavItem(1)
            },

            nextPage(e){
                const value = Number(e.target.getAttribute('value'))

                if (this.curPage !== value){
                    this.items = null;

                    this.navigationTable(value)

                    if (this.curPage < this.lastPage){
                        this.curPage += 1;
                    }
                }
            },

            previousPage(e){
                const value = Number(e.target.getAttribute('value'))

                if (this.curPage !== value){
                    this.items = null;

                    this.navigationTable(value)

                    if (this.curPage > 1){
                        this.curPage -= 1;
                    }
                }
            },

            changeButton(e){
                const oid   = e.target.getAttribute('id')
                var tag     = document.getElementById(oid)
                const type  = e.target.getAttribute('type')

                if (type === 'input'){
                    tag.classList.remove('!w-16')
                    tag.autofocus = false
                    tag.value = '...'
                    tag.setAttribute('type', 'button')
                }
            },

            changeInput(e){
                const oid   = e.target.getAttribute('id')
                var tag     = document.getElementById(oid)
                const value = Number(e.target.getAttribute('value'))

                if(Number.isNaN(value)){
                    let newValue = ''
                    tag.classList.add('!w-16')
                    tag.classList.remove('hover:cursor-pointer')
                    tag.autofocus = true
                    tag.removeAttribute('value')
                    tag.setAttribute('type', 'input')
                    tag.addEventListener('input', function (){
                        tag.setAttribute('value', tag.value)
                    })
                }

                if (this.curPage !== value){
                    if(Number.isInteger(value) && tag.getAttribute('type') === 'button'){
                        this.items = null

                        this.curPage = value
                        this.navigationTable(value)
                    }
                }
            },

            jumpTo(e){
                let value = Number(e.target.getAttribute('value'))

                if (value > this.lastPage){
                    value = this.lastPage
                }

                if (this.curPage !== value){
                    this.items = null
                    this.navItems = null
                    this.navigationTable(value)
                    this.curPage = value
                }
            },

            async navigationTable(value){
                const search = document.getElementById('search-input')
                const searchValue = search.value !== '' ? '&search=' + search.value : ''

                let resp = await fetch('http://localhost:8080/masyarakat/data?page=' + value + searchValue )
                const listItems = await resp.json();
                const nextButton = document.getElementById('next')

                const previousButton = document.getElementById('previous')
                if (this.curPage < listItems.last_page){

                    nextButton.value = this.curPage + 1
                }
                if(this.curPage > 1){
                    previousButton.value = this.curPage - 1
                }

                this.updateNavItem(value)

                this.items = listItems.data
            },

            updateNavItem(value){
                console.log(this.navItems)

                let wahey = [];
                id=1;
                itemPage = 1;

                wahey[0] = {'id': 'page-1', 'value': 1, 'text': 1}
                if (this.curPage - 4 >= 1) {
                    itemPage++
                    wahey[id] = {'id': 'page-' + itemPage, 'value': '...', 'text': '...'}
                    id++
                }
                for (var i = this.curPage - 2; i < this.curPage; i++) {
                    if (this.curPage !== i && i > 1) {
                        itemPage++
                        wahey[id] = {'id': 'page-' + itemPage, 'value': i, 'text': i}
                        id++
                    }
                }

                if (this.curPage === value && this.curPage !== 1 && this.curPage !== this.lastPage) {
                    itemPage++
                    wahey[id] = {'id': 'page-' + itemPage, 'value': this.curPage, 'text': this.curPage}
                    id++
                }

                for (var j = this.curPage + 1; j < this.curPage + 3; j++) {
                    if (this.curPage !== j && j < this.lastPage) {
                        itemPage++
                        wahey[id] = {'id': 'page-' + itemPage, 'value': j, 'text': j}
                        id++;
                    }
                }
                if (this.curPage + 4 <= this.lastPage) {
                    itemPage++
                    wahey[id] = {'id': 'page-' + itemPage, 'value': '...', 'text': '...'}
                    id++
                }
                if (this.lastPage !== 1) {
                    wahey[id] = {'id': 'page-' + id, 'value': this.lastPage, 'text': this.lastPage}
                }

                this.navItems = wahey
            },

            selectItem(e){
                const id = Number(e.target.getAttribute('id'))
                let searchedItem = this.items.find(o => Number(o.no_nik) === id);

                document.getElementById('edit-old-email').value = searchedItem.user?.email
                document.getElementById('edit-id').value = searchedItem.no_nik
                document.getElementById('edit-nama').value = searchedItem.nama
                document.getElementById('edit-email').value = searchedItem.user?.email
                document.getElementById('edit-nik').value = searchedItem.no_nik
                document.getElementById('edit-alamat').value = searchedItem.alamat
                document.getElementById('edit-telephone').value = searchedItem.nomor_telepon
            },
        }))
    });
</script>
<script>
    let modalId = null;
    let overlay = document.querySelectorAll('.modal-overlay')
    for(var i=0; i < overlay.length; i++){
        overlay[i].addEventListener('click', click)
    }

    function toggleModal (id) {
        const body = document.querySelector('body')
        const modal = document.getElementById(id)

        modalId = id

        modal.classList.toggle('opacity-0')
        modal.classList.toggle('pointer-events-none')
        body.classList.toggle('modal-active')
    }

    document.onkeydown = function(evt) {
        evt = evt || window.event
        var isEscape = false
        if ("key" in evt) {
            isEscape = (evt.key === "Escape" || evt.key === "Esc")
        } else {
            isEscape = (evt.keyCode === 27)
        }
        if (isEscape && document.body.classList.contains('modal-active')) {
            toggleModal(modalId)
        }
    };

    function click(){
        overlay.addEventListener('click', toggleModal(modalId))
    }
</script>
