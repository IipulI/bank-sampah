<x-app-layout>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <!-- Content -->
            <div class="bg-white rounded-md shadow-md">
                <div x-data="anggota" class="px-4 py-4">
                    <div class="flex items-center border-b-2 py-2">
                        <div class="ml-4 font-semibold font-grey-600">Anggota</div>
                        <div class="mr-4 w-80 lg:w-2/4 px-4">
                            <div x-data="selectConfigs()" x-init="fetchOptions()" class="flex flex-col items-center relative">
                                <div class="hidden">
                                    <label for="anggota_id">AnggotaId</label>
                                    <input x-model="anggotaId" name="anggota_id" id="anggota_id">
                                </div>

                                <div class="w-full">
                                    <div @click.away="close()" class="my-2 p-1 bg-white flex border border-gray-200 rounded shadow-md">
                                        <input
                                            x-model="filter"
                                            @input="searchRelatedData"
                                            @click="open()"
                                            @keydown.enter.stop.prevent="selectOption()"
                                            @keydown.arrow-up.prevent="focusPrevOption()"
                                            @keydown.arrow-down.prevent="focusNextOption()"
                                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800" placeholder="ketik nama anggota">
                                    </div>
                                </div>

                                <div x-show="isOpen()" class="absolute mt-14 max-h-72 shadow bg-white top-100 z-40 w-full rounded overflow-y-auto">
                                    <div class="flex flex-col w-full">
                                        <template x-for="(option, index) in filteredOptions()" :key="index">
                                            <div @click="onOptionClick(index)" :class="classOption(option.id, index)" :aria-selected="focusedOptionIndex === index">
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

                    <div class="border-b-2">
                        <span class="mx-4 font-semibold text-gray-700 text-xl">Informasi Anggota</span>

                        <table class="my-4 mx-8 text-left">
                            <tr>
                                <th class="text-gray-700 font-semibold text-lg">Nama</th>
                                <td class="px-2 hidden md:block">:</td>
                                <template x-if="selectedMember !== null">
                                    <td x-text="selectedMember?.nama"></td>
                                </template>
                                <template x-if="!selectedMember">
                                    <td >Pilih Anggota Terlebih Dahulu</td>
                                </template>
                            </tr>
                            <tr>
                                <th class="text-gray-700 font-semibold text-lg">Jumlah Dana</th>
                                <td class="px-2 hidden md:block">:</td>
                                <template x-if="selectedMember !== null">
                                    <td>
                                        <input x-model="jumlahDana">
                                    </td>
                                </template>
                                <template x-if="!selectedMember">
                                    <td >Pilih Anggota Terlebih Dahulu</td>
                                </template>
                            </tr>
                            <tr>
                                <th class="text-gray-700 font-semibold text-lg">No NIK</th>
                                <td class="px-2 hidden md:block">:</td>
                                <template x-if="selectedMember !== null">
                                    <td x-text="selectedMember?.no_nik"></td>
                                </template>
                                <template x-if="!selectedMember">
                                    <td >Pilih Anggota Terlebih Dahulu</td>
                                </template>
                            </tr>
                            <tr>
                                <th class="text-gray-700 font-semibold text-lg">Terakhir Kali Tarik</th>
                                <td class="px-2 hidden md:block">:</td>
                                <template x-if="selectedMember !== null">
                                    <td x-text="selectedMember?.latest_transaksi?.tanggal_transaksi"></td>
                                </template>
                                <template x-if="!selectedMember">
                                    <td >Pilih Anggota Terlebih Dahulu</td>
                                </template>
                            </tr>
                        </table>
                    </div>

                    <form>
                        @csrf
                        <div class="border-b-2">
                            <div class="mx-4 my-4">
                                <div class="flex flex-wrap items-center gap-x-2 my-2">
                                    <div class="w-48">
                                        <label for="jumlah-tarik" class="font-semibold text-gray-600">Jumlah Yang Ingin Ditarik</label>
                                    </div>
                                    <input x-model="inputTarik" x-on:blur="calculateAfter"
                                           name="jumlahTarik" id="jumlah-tarik" class="shadow-md rounded border px-2 py-1 border-gray-300 bg-gray-100" disabled>
                                </div>
                                <div class="flex flex-wrap items-center gap-x-2 my-2">
                                    <div class="w-48">
                                        <label for="setelah-tarik" class="font-semibold text-gray-600">Dana setelah ditarik</label>
                                    </div>
                                    <input x-model="setelahTarik"
                                           name="setelahTarik" id="setelah-tarik" class="shadow-md rounded border px-2 py-1 border-gray-300 bg-gray-100" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="mx-4 mt-4">
                            <button x-on:click="submitData" type="button"
                                    class="px-4 py-2 bg-blue-500 rounded-md shadow-md text-white font-semibold text-md hover:bg-blue-400">Request Tarik</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener('alpine:init', () =>{
        Alpine.data('anggota', () => ({
            selectedMember: null,
            filteredDate: null,
            setelahTarik: '',
            jumlahDana: '',
            inputTarik: '',

            calculateAfter(){
                this.setelahTarik = this.jumlahDana

                this.setelahTarik = this.setelahTarik - this.inputTarik
                if(this.setelahTarik < 0){
                    this.setelahTarik = this.jumlahDana
                    this.inputTarik = ''
                }
            },

            async submitData(){
                let obj = {
                    inputTarik : this.inputTarik,
                    anggotaId : this.selectedMember.id
                }

                let callApi = await fetch('http://localhost:8080/request-tarik-dana/submit', {
                    method: "post",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-type": "application/json"
                    },
                    body: JSON.stringify(obj)
                });
                const response = callApi.json();

                if (callApi.ok){
                    window.location.href = "http://localhost:8080/histori-transaksi";
                }
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
            selectedId() { return this.selected ? this.selected.id : this.filter },
            classOption(id, index) {
                const isSelected = this.selected ? (id === this.selected.id) : false;
                const isFocused = (index === this.focusedOptionIndex);
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
                const inputIn = document.getElementById('jumlah-tarik');
                inputIn.disabled = true;
                inputIn.classList.add('bg-gray-100');

                if (!this.isOpen()) {
                    return;
                }
                this.focusedOptionIndex = this.focusedOptionIndex ?? 0;
                const selected = this.filteredOptions()[this.focusedOptionIndex]
                if (this.selected && this.selected.id === selected.id) {
                    // this.filter = '';
                    // this.selected = null;
                    // this.selectedMember = null;
                }
                else {
                    let latestDate = new Date()

                    this.selected = selected;
                    this.selectedMember = this.selected
                    this.filter = this.selectedName();
                    this.anggotaId = this.selectedId();

                    this.setelahTarik = this.selected?.tabungan?.jumlah_uang != null ? this.selected?.tabungan?.jumlah_uang : '';
                    this.jumlahDana = this.selected?.tabungan?.jumlah_uang != null ? this.selected?.tabungan?.jumlah_uang : '';
                    this.inputTarik = '';
                }

                // input
                if(this.jumlahDana !== ''){
                    inputIn.removeAttribute('disabled');
                    inputIn.classList.remove('bg-gray-100');
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
                else if (this.focusedOptionIndex === 0) {
                    this.focusedOptionIndex = optionsNum;
                }
            },
            focusNextOption() {
                const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                if (!this.isOpen()) {
                    this.open();
                }
                if (this.focusedOptionIndex == null || this.focusedOptionIndex === optionsNum) {
                    this.focusedOptionIndex = 0;
                }
                else if (this.focusedOptionIndex >= 0 && this.focusedOptionIndex < optionsNum) {
                    this.focusedOptionIndex++;
                }
            }
        }))
    })
</script>
