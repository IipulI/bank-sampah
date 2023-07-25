<x-app-layout>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">

            <form id="submit-form" method="post" action="{{ route('setor-sampah.submit-data') }}" >
                @csrf
                <div class="bg-white rounded-md shadow-md">
                    <div class="px-4 py-2">
                        <div class="flex items-center border-b-2 py-2">
                            <div class="ml-4 font-semibold font-grey-600">Masyarakat</div>
                            <div class="mr-4 w-2/4 px-4">
                                <div x-data="selectConfigs()" x-init="fetchOptions()" class="flex flex-col items-center relative">
                                    <div class="hidden">
                                        <label for="anggota_id">AnggotaId</label>
                                        <input x-model="anggotaId" name="no_nik" id="anggota_id">
                                    </div>

                                    <div class="w-full">
                                        <div @click.away="close" class="my-2 p-1 bg-white flex border border-gray-200 rounded shadow-md">
                                            <input
                                                x-model="filter"
                                                @input="searchRelatedData"
                                                @click="open"
                                                @keydown.enter.stop.prevent="selectOption()"
                                                @keydown.arrow-up.prevent="focusPrevOption()"
                                                @keydown.arrow-down.prevent="focusNextOption()"
                                                class="p-1 px-2 appearance-none outline-none w-full text-gray-800" placeholder="ketik nama masyarakat">
                                        </div>
                                    </div>

                                    <div x-show="isOpen()" class="absolute mt-14 max-h-72 shadow bg-white top-100 z-40 w-full rounded overflow-y-auto">
                                        <div class="flex flex-col w-full">
                                            <template x-for="(option, index) in filteredOptions" :key="index">
                                                <div @click="onOptionClick(index)" :class="classOption(option.no_nik, index)" :aria-selected="focusedOptionIndex === index">
                                                    <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                                        <div class="w-full items-center flex">
                                                            <div class="mx-2 -mt-1"><span x-text="option.nama"></span>
                                                                <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500" x-text="'No NIK : '+option.no_nik"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-8 mb-4 border border-gray-200">

                            <div class="px-4 py-4">
                                <div x-data="handler">
                                    <table class="align-items-center table-sm w-full">
                                        <template x-for="(field, key) in fields" :key="key">
                                            <tr x-data="searchData" class="flex items-start justify-around py-2">
                                                <td x-data="{ id: 'item-id-' + (key+1)  }" class="hidden">
                                                    <label :for="key + 1" class="font-semibold text-gray-600 mx-2">Id</label>
                                                    <input x-model="field.item" type="text" name="item[]" :id="id"
                                                           class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </td>
                                                <td class="font-bold text-gray-900 flex-none text-center">
                                                    <div x-text="key + 1" class="block w-8 mt-[0.3rem]"></div>
                                                </td>
                                                <td x-data="{ id: 'barang-'+ (key+1) }">
                                                    <label :for="id" class="font-semibold text-gray-600 mx-2">Nama Barang</label>
                                                    <div class="inline-flex">
                                                        <input x-model="field.barang" :id="id" x-on:click="open"
                                                               x-on:input="inputedChar"
                                                               type="text" name="nama[]"
                                                               class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

                                                        <div x-show="isOpen" class="absolute mx-2 mt-[2.75rem] max-h-48 w-44 shadow-lg bg-white top-100 z-40 rounded overflow-y-auto" x-on:click.away="close">
                                                            <div class="flex flex-col">
                                                                <template x-if="!data">
                                                                    <template x-for="1 in 5">
                                                                        <div class="animate-pulse w-full items-center p-2 relative">
                                                                            <div class="mx-2 my-1.5 w-3/4 h-2 bg-slate-400 rounded-lg"></div>
                                                                        </div>
                                                                    </template>
                                                                </template>
                                                                <template x-cloak x-for="(option, index) in data" :key="index">
                                                                        <div x-on:click='selectOption(index, key)' class="w-full items-center p-2 pl-2 relative hover:bg-teal-100" :class="!data ? 'hidden' : ''">
                                                                            <div class="mx-2 -mt-1">
                                                                                <span x-text="option.nama" class="cursor-default"></span>
                                                                            </div>
                                                                        </div>
                                                                </template>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td x-data="{ id: 'satuan-' + (key+1), idText : 'satuan-text-' + (key+1), idHargaSatuan: 'harga-satuan-text-' + (key+1)}">
                                                    <label :for="id" class="font-semibold text-gray-600 mx-2">Satuan</label>
                                                    <div class="inline-flex items-center">
                                                        <input x-model="field.satuan" type="number" step="0.1" name="satuan[]" :id="id" x-on:blur="calculateHarga(key)"
                                                               class="rounded-tl-md rounded-bl-md border-0 ml-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-gray-100" disabled>
                                                        <div class="rounded-tr-md rounded-br-md bg-gray-200 mr-2 px-2 py-1.5 ring-1 ring-inset ring-gray-300 w-10 max-w-10" :id="idText">...</div>
                                                    </div>
                                                    <div class="flex justify-end">
                                                        <input x-model="field.hargaSatuan" class="bg-white text-right text-sm font-semibold text-gray-600 mx-4" :id="idHargaSatuan" disabled></input>
                                                    </div>
                                                </td>
                                                <td x-data="{ id: 'harga-' + (key+1) }">
                                                    <label :for="id" class="font-semibold text-gray-600 mx-2">Harga</label>
                                                    <input x-model="field.harga" type="text" name="harga[]" :id="id"
                                                           class="bg-gray-100 rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 cursor-not-allowed focus:ring-inset focus:ring-gray-300 sm:text-sm sm:leading-6" readonly>
                                                </td>
                                                <td>
                                                    <button type="button" class="bg-red-500 text-white font-semibold rounded-md max-h-16 shadow-md px-2 py-1.5 hover:bg-red-400 h-fit" @click="removeField(key)">Hapus</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </table>

                                    <div class="border-b pt-4 w-full overflow-auto inline-block">
                                        <div class="mt-4">
                                            <span class="text-left font-semibold"><button type="button" class="my-2" @click="addNewField()">+ Add Row</button></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2 flex items-center justify-around">
                                    <div class="px-2 invisible">
                                        <label class="font-semibold text-gray-600 mx-2">Nama Barang</label>
                                        <input type="text" name="nama" class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" disabled> <!-- "text-input-1" -->
                                    </div>
                                    <div class="border-l-2 invisible"></div>
                                    <div class="px-2 invisible">
                                        <label class="font-semibold text-gray-600 mx-2">Berat</label>
                                        <input type="text" name="satuan-2" class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" disabled> <!-- "text-input-1" -->
                                    </div>
                                    <div class="border-l-2 invisible"></div>
                                    <div class="px-2">
                                        <label for="total-harga" class="font-semibold text-gray-600 mx-2">Total Harga</label>
                                        <input type="text" name="total_harga" id="total-harga" class="bg-gray-100 rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-inset focus:ring-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm sm:leading-6" readonly>
                                    </div>
                                    <div class="border-l-2"></div>

                                    <button type="submit" class="rounded-md bg-blue-500 hover:bg-blue-400 shadow-sm font-semibold text-white px-2 py-1.5">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('searchData', () => ({
            show:false,
            data: null,
            selected: null,
            filteredData: null,
            focusedOptionIndex : null,
            rowItemId : null,
            async init(){
                let resp = await fetch('http://localhost:8080/setor-sampah/data');
                listItems = resp.json()
                this.data = listItems

                this.filteredData = listItems.then((data) => {
                    this.filteredData = data
                })
            },

            async inputedChar(e){
                this.data = null
                const element = e.target
                const id = element.getAttribute('id').slice(7)
                let char = this.fields[id-1]

                let resp = await fetch('http://localhost:8080/setor-sampah/data?q=' + char.barang)
                listItems = resp.json()
                this.data = listItems

                this.filteredData = listItems.then((data) => {
                    this.filteredData = data
                })

            },

            async getDetailSampah(id, col){
                let resp = await fetch('http://localhost:8080/setor-sampah/search?id=' + id + col)
                return resp.json()
            },

            selectOption(index, key){
                this.rowItemId = null
                this.rowItemId = key + 1

                this.fields[key].index = index
                this.fields[key].barang = this.filteredData[index].nama
                this.fields[key].item = this.filteredData[index].tipe_sampah_id
                this.fields[key].hargaSatuan = 'Harga satuan : '+this.filteredData[index].harga_satuan
                this.fields[key].rawHargaSatuan = +this.filteredData[index].harga_satuan

                document.getElementById('satuan-' + this.rowItemId).classList.remove('bg-gray-100')
                document.getElementById('satuan-' + this.rowItemId).removeAttribute('disabled')

                const satuanTeks = document.getElementById('satuan-text-' + this.rowItemId)
                satuanTeks.innerText = this.filteredData[index].satuan

                this.close()
            },

            calculateHarga(){
                const len = this.fields.length
                var totalHarga = null

                for (var i=0; i<=len-1; i++){
                    const itemSatuan = this.fields[i].rawHargaSatuan * this.fields[i].satuan
                    this.fields[i].harga = itemSatuan

                    totalHarga += itemSatuan
                }
                document.getElementById('total-harga').value = totalHarga
            },

            open(){
                this.show = true;
            },

            close(){
                this.show = false;
            },

            isOpen() {
                return this.show === true;
            },

        }))

        Alpine.data('handler', () => ({
            fields: [],
            show:false,
            totalHarga: null,
            addNewField() {
                this.fields.push({
                    item: '',
                    barang: '',
                    satuan: '',
                    rawHargaSatuan : '',
                    hargaSatuan : 'Harga satuan : ',
                    harga: ''
                });
            },

            removeField(index) {
                const inputTotalHarga = document.getElementById('total-harga')
                const curTotalValue = Number(inputTotalHarga.value)
                const rowHarga = this.fields[index].harga

                const totalValue = curTotalValue - rowHarga

                inputTotalHarga.value = totalValue

                this.fields.splice(index, 1);
            }
        }))

        Alpine.data('selectConfigs', () => ({
            anggotaId: '',
            filter: '',
            show: false,
            selected: null,
            focusedOptionIndex: null,
            options: null,
            close() {
                this.show = false;
                this.filter = this.selectedName();
                this.focusedOptionIndex = this.selected ? this.focusedOptionIndex : null;
            },
            open() {
                this.show = true;
                this.filter = '';
            },
            toggle() {
                if (this.show) {
                    this.close();
                }
                else {
                    this.open()
                }
            },
            isOpen() { return this.show === true },
            selectedName() { return this.selected ? this.selected.nama : this.filter; },
            selectedId() { return this.selected ? this.selected.no_nik : this.filter },
            classOption(id, index) {
                const isSelected = this.selected ? (id == this.selected.no_nik) : false;
                const isFocused = (index == this.focusedOptionIndex);
                return {
                    'cursor-pointer w-full border-gray-100 border-b hover:bg-blue-50': true,
                    'bg-blue-100': isSelected,
                    'bg-blue-50': isFocused
                };
            },
            fetchOptions() {
                fetch('http://localhost:8080/setor-sampah/member')
                    .then(response => response.json())
                    .then(data => this.options = data);
            },
            searchRelatedData(){
                this.options = null;

                fetch('http://localhost:8080/setor-sampah/member?search=' + this.filter)
                    .then(response => response.json())
                    .then(data => this.options = data);
            },
            filteredOptions() {
                return this.options
                    ? this.options.filter(option => {
                        return (option.nama.toLowerCase().indexOf(this.filter) > -1)
                            // || (option.name.last.toLowerCase().indexOf(this.filter) > -1)
                            // || (option.email.toLowerCase().indexOf(this.filter) > -1)
                    })
                    : {}
            },
            onOptionClick(index) {
                this.focusedOptionIndex = index;
                this.selectOption();
            },
            selectOption() {
                if (!this.isOpen()) {
                    return;
                }
                this.focusedOptionIndex = this.focusedOptionIndex ?? 0;
                const selected = this.filteredOptions()[this.focusedOptionIndex]
                if (this.selected && this.selected.no_nik == selected.no_nik) {
                    this.filter = '';
                    this.selected = null;
                }
                else {
                    this.selected = selected;
                    this.filter = this.selectedName();
                    this.anggotaId = this.selectedId();
                }
                this.close();
            },
            focusPrevOption() {
                if (!this.isOpen()) {
                    return;
                }
                const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                if (this.focusedOptionIndex > 0 && this.focusedOptionIndex <= optionsNum) {
                    this.focusedOptionIndex--;
                }
                else if (this.focusedOptionIndex == 0) {
                    this.focusedOptionIndex = optionsNum;
                }
            },
            focusNextOption() {
                const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                if (!this.isOpen()) {
                    this.open();
                }
                if (this.focusedOptionIndex == null || this.focusedOptionIndex == optionsNum) {
                    this.focusedOptionIndex = 0;
                }
                else if (this.focusedOptionIndex >= 0 && this.focusedOptionIndex < optionsNum) {
                    this.focusedOptionIndex++;
                }
            }
        }))
    })
</script>
<script>
    const form = document.getElementById('submit-form');
    form.addEventListener('keypress', function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();
        }
    });
</script>

