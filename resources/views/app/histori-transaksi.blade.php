<x-app-layout>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <!-- Content -->
            <div x-data="listSampah" class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <!-- Head Table -->
                <div class="flex items-center justify-between px-4 py-4 bg-white dark:bg-gray-800">

                    <!-- Filter -->
                    <div>
                        <select id="filter-type" x-on:input="filterType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled value="">Arus Transaksi</option>
                            <option value="masuk">Masuk</option>
                            <option value="keluar">Keluar</option>
                        </select>
                    </div>

                    <!-- Datepicker -->
                    <div id="dateRangePickerId" class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <label for="date-start" class="text-sm font-semibold hidden">Date start</label>
                            <input id="date-start" name="date-start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal awalan">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <label for="date-end" class="text-sm font-semibold hidden">Date end</label>
                            <input id="date-end" name="date-end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal akhiran">
                        </div>
                        <div class="relative">
                            <button x-on:click="filterDate"
                                class="bg-blue-500 px-4 py-2 ml-2 rounded-md shadow-md text-sm font-semibold text-white focus:outline-none hover:bg-blue-600 focus:bg-blue-600 focus:ring-offset-1 focus:ring-2 focus:ring-blue-500">Filter</button>
                        </div>
                    </div>

                    <!-- Search Item -->
                    <div class="text-sm w-2/6">
                        <label for="search-input" class="sr-only">Search</label>
                        <div class="relative flex rounded-md shadow-sm">
                            <input id="search-input" type="search"  name="query" x-on:keyup.enter="searchSubmit" x-on:input="searchInput"
                                   class="py-2 px-4 pl-11 block w-full border-gray-200 shadow-sm rounded-l-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                   @canany(['admin', 'staff'])
                                   placeholder="Cari nama masyarakat atau kode transaksi"
                                   @endcanany
                                   @canany(['member'])
                                   placeholder="Cari kode transaksi"
                                   @endcanany
                            >
                            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-20 pl-4">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </div>
                            <button id="search-submit" x-on:click="searchSubmit" type="submit" class="py-2 px-4 inline-flex flex-shrink-0 justify-center items-center rounded-r-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:z-10 focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 focus:bg-blue-600 transition-all text-sm">Search</button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div>
                    <table id="sampahTable" class="px-4 border-b-2 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Masyarakat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode Transaksi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanngal Transaksi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Arus Transaksi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Uang
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
                        </template>
                        <template x-if="items?.length === 0">
                            <tr aria-label="table-row" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 text-gray-900 font-semibold text-lg text-center" colspan="6">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                        </template>
                        <template x-for="transaksi in items" x-cloak>
                            <tr aria-label="table-row" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                :class="!items ? 'hidden' : ''">
                                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold" x-text="transaksi?.masyarakat?.nama"></div>
                                    </div>
                                </th>
                                <td class="px-6 py-4" x-text="transaksi.kode_transaksi"></td>
                                <td class="px-6 py-4" x-text="transaksi.tanggal_transaksi"></td>
                                <td class="px-6 py-4" x-text="transaksi.arus_transaksi"></td>
                                <td class="px-6 py-4" x-text="transaksi.jumlah_uang"></td>
                                <td class="px-6 py-4">
                                    <button x-on:click="detailTransaksi" :id="'detail-' + transaksi.transaksi_id" class="text-indigo-600">Detail</button>
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
                                            <path fill-rule="evenodd" d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z" clip-rule="evenodd"></path><q></q>
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
                let resp = await fetch('http://localhost:8080/histori-transaksi/data');
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
                if (this.lastPage <= 5){
                    var m = 1;
                    for (var n=0; n < this.lastPage; n++){
                        wahey[n] = { 'id': "page-"+m, 'value': m, 'text': m}
                        m++
                    }
                }
                if(this.lastPage > 5){
                    var m = 1;
                    for (var n=0; n < 3; n++){
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

            async filterType(){
                const elemType = document.getElementById('filter-type')

                if(elemType.value !== '' || elemType.value !== null){
                    this.navItems = null
                    this.items = null
                    this.lastPage = null
                    this.curPage = 1

                    const elemSearch = document.getElementById('search-input')
                    const elemDateStart = document.getElementById('date-start')
                    const elemDateEnd = document.getElementById('date-end')

                    let search = elemSearch.value !== '' ? 'search=' + elemSearch.value : ''

                    let filterDate = ''
                    if (elemDateEnd.value !== '' || elemDateStart.value !== ''){
                        filterDate = search === ''
                            ? 'date-start=' + elemDateStart.value + '&date-end=' + elemDateEnd.value
                            : '&date-start=' + elemDateStart.value + '&date-end=' + elemDateEnd.value
                    }

                    let filterType = search === '' && filterDate === ''
                        ? 'type=' + elemType.value
                        : '&type=' + elemType.value


                    let resp = await fetch('http://localhost:8080/histori-transaksi/data?' + search + filterDate + filterType)
                    let response = await resp.json()

                    this.lastPage = response.last_page
                    this.items = response.data

                    this.updateNavItem(1)
                }
            },

            async searchSubmit(){
                const elemSearch = document.getElementById('search-input')

                if(elemSearch.value !== ''){
                    this.navItems = null
                    this.items = null
                    this.lastPage = null
                    this.curPage = 1

                    const elemType = document.getElementById('filter-type')
                    const elemDateStart = document.getElementById('date-start')
                    const elemDateEnd = document.getElementById('date-end')

                    let search = elemSearch.value !== '' ? 'search=' + elemSearch.value : ''

                    let filterDate = ''
                    if (elemDateEnd.value !== '' || elemDateStart.value !== ''){
                        filterDate = search === ''
                            ? 'date-start=' + elemDateStart.value + '&date-end=' + elemDateEnd.value
                            : '&date-start=' + elemDateStart.value + '&date-end=' + elemDateEnd.value
                    }

                    let filterType = search === '' && filterDate === ''
                        ? 'type=' + elemType.value
                        : '&type=' + elemType.value


                    let resp = await fetch('http://localhost:8080/histori-transaksi/data?' + search + filterDate + filterType)
                    let response = await resp.json()

                    this.lastPage = response.last_page
                    this.items = response.data

                    this.updateNavItem(1)
                }
            },

            async filterDate(){
                const elemDateStart = document.getElementById('date-start')
                const elemDateEnd = document.getElementById('date-end')

                if (elemDateStart.value !== '' || elemDateEnd.value !== ''){
                    this.navItems = null
                    this.items = null
                    this.lastPage = null
                    this.curPage = 1

                    const elemSearch = document.getElementById('search-input')
                    const elemType = document.getElementById('filter-type')

                    let search = elemSearch.value !== '' ? 'search=' + elemSearch.value : ''

                    let filterDate = ''
                    if (elemDateEnd.value !== '' || elemDateStart.value !== ''){
                        filterDate = search === ''
                            ? 'date-start=' + elemDateStart.value + '&date-end=' + elemDateEnd.value
                            : '&date-start=' + elemDateStart.value + '&date-end=' + elemDateEnd.value
                    }

                    let filterType = search === '' && filterDate === ''
                        ? 'type=' + elemType.value
                        : '&type=' + elemType.value


                    let resp = await fetch('http://localhost:8080/histori-transaksi/data?' + search + filterDate + filterType)
                    let response = await resp.json()

                    this.lastPage = response.last_page
                    this.items = response.data

                    this.updateNavItem(1)
                }
            },

            nextPage(e){
                const value = Number(e.target.getAttribute('value'))

                if (this.curPage !== value && this.lastPage !== 1){
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


                const dateStart = document.getElementById('date-start')
                const dateEnd = document.getElementById('date-end')
                const filterDateStart = dateStart.value !== '' ? '&date-start=' + dateStart.value : ''
                const filterDateEnd = dateEnd.value !== '' ? '&date-end=' + dateEnd.value : ''
                const filter = filterDateStart + filterDateEnd
                const filterDate = filter !== '' ? filter : ''


                let resp = await fetch('http://localhost:8080/histori-transaksi/data?page=' + value + searchValue + filterDate )
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

            detailTransaksi(e){
                const oid = (e.target.getAttribute('id'))
                const id = Number(oid.slice(7))
                let searchedItem = this.items.find(o => o.transaksi_id === id);

                console.log(searchedItem)

                window.location.href = "http://localhost:8080/histori-transaksi/detail?kode=" + searchedItem.kode_transaksi;
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
@vite(['resources\js\datepick.js'])
