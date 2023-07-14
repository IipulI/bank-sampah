<x-app-layout>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">

            <div class="bg-white rounded-md shadow-md">
                <div class="px-4 py-2">
                    <div class="flex items-center border-b-2 py-2">
                        <div class="font-semibold font-grey-600">Anggota</div>
                        <div class="w-full px-4">
                            <div x-data="selectConfigs()" x-init="fetchOptions()" class="flex flex-col items-center relative">
                                <div class="w-full">
                                    <div @click.away="close()" class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                                        <input
                                            x-model="filter"
                                            @click="open()"
                                            @keydown.enter.stop.prevent="selectOption()"
                                            @keydown.arrow-up.prevent="focusPrevOption()"
                                            @keydown.arrow-down.prevent="focusNextOption()"
                                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800">
                                        <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">
                                            <button @click="toggle()" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                <svg  xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline x-show="!isOpen()" points="18 15 12 20 6 15"></polyline>
                                                    <polyline x-show="isOpen()" points="18 15 12 9 6 15"></polyline>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <div x-show="isOpen()" class="absolute mt-14 max-h-72 shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                                    <div class="flex flex-col w-full">
                                        <template x-for="(option, index) in filteredOptions()" :key="index">
                                            <div @click="onOptionClick(index)" :class="classOption(option.login.uuid, index)" :aria-selected="focusedOptionIndex === index">
                                                <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                                    <div class="w-6 flex flex-col items-center">
                                                        <div class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full "><img class="rounded-full" alt="A" x-bind:src="option.picture.thumbnail"> </div>
                                                    </div>
                                                    <div class="w-full items-center flex">
                                                        <div class="mx-2 -mt-1"><span x-text="option.name.first + ' ' + option.name.last"></span>
                                                            <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500" x-text="option.email"></div>
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

                    <div class="mt-8 border border-gray-200">

                        <div class="px-4 py-4" x-data="handler()">
                            <form method="post" action="/test/hit">
                                @csrf
                                <div class="border-b w-full overflow-auto inline-block">
                                    <table id="table" class="table table-auto w-full">
                                        <tbody>
                                        <template x-for="(field, index) in fields" :key="index">
                                            <tr>
                                                <td>
                                                    <div class="flex items-end justify-around gap-x-2 py-2">
                                                        <div x-data="{ id: $id('text-input') }" class="px-2">
                                                            <label :for="id" class="font-semibold text-gray-600 mx-2">Nama Barang</label>
                                                            <input type="text" name="text1[]" :id="id" class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> <!-- "text-input-1" -->
                                                        </div>
                                                        <div class="border-l-2"></div>
                                                        <div x-data="{ id: $id('text-input-2') }" class="px-2">
                                                            <label :for="id" class="font-semibold text-gray-600 mx-2">Berat</label>
                                                            <input type="text" name="text2[]" :id="id" class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> <!-- "text-input-1" -->
                                                        </div>
                                                        <div class="border-l-2"></div>
                                                        <div x-data="{ id: $id('text-input-3') }" class="px-2">
                                                            <label :for="id" class="font-semibold text-gray-600 mx-2">Harga</label>
                                                            <input type="text" name="text3[]" :id="id" class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> <!-- "text-input-1" -->
                                                        </div>
                                                        <div class="border-l-2"></div>

                                                        <button type="button" class="bg-red-500 text-white font-semibold rounded-md max-h-16 shadow-md px-2 py-1.5 hover:bg-red-400 h-fit" @click="removeField(index)">Hapus</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-left font-semibold"><button type="button" class="my-2" @click="addNewField()">+ Add Row</button></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="mt-2 flex items-center justify-around">
                                    <div x-data="{ id: $id('text-input') }" class="px-2 invisible">
                                        <label :for="id" class="font-semibold text-gray-600 mx-2">Nama Barang</label>
                                        <input type="text" name="text1[]" :id="id" class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> <!-- "text-input-1" -->
                                    </div>
                                    <div class="border-l-2 invisible"></div>
                                    <div x-data="{ id: $id('text-input-2') }" class="px-2 invisible">
                                        <label :for="id" class="font-semibold text-gray-600 mx-2">Berat</label>
                                        <input type="text" name="text2[]" :id="id" class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> <!-- "text-input-1" -->
                                    </div>
                                    <div class="border-l-2 invisible"></div>
                                    <div x-data="{ id: $id('text-input-3') }" class="px-2">
                                        <label :for="id" class="font-semibold text-gray-600 mx-2">Total Harga</label>
                                        <input type="text" name="text3[]" :id="id" class="rounded-md border-0 mx-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> <!-- "text-input-1" -->
                                    </div>
                                    <div class="border-l-2"></div>

                                    <button type="submit" class="rounded-md bg-blue-500 hover:bg-blue-400 shadow-sm font-semibold text-white px-2 py-1.5">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="flex flex-col items-center">--}}
{{--                <div class="w-full md:w-1/2 flex flex-col items-center h-64">--}}
{{--                    <div class="w-full px-4">--}}

{{--                        <div x-data="selectConfigs()" x-init="fetchOptions()" class="flex flex-col items-center relative">--}}
{{--                            <div class="w-full">--}}
{{--                                <div @click.away="close()" class="my-2 p-1 bg-white flex border border-gray-200 rounded">--}}
{{--                                    <input--}}
{{--                                        x-model="filter"--}}
{{--                                        @click="open()"--}}
{{--                                        @keydown.enter.stop.prevent="selectOption()"--}}
{{--                                        @keydown.arrow-up.prevent="focusPrevOption()"--}}
{{--                                        @keydown.arrow-down.prevent="focusNextOption()"--}}
{{--                                        class="p-1 px-2 appearance-none outline-none w-full text-gray-800">--}}
{{--                                    <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">--}}
{{--                                        <button @click="toggle()" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">--}}
{{--                                            <svg  xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                                <polyline x-show="!isOpen()" points="18 15 12 20 6 15"></polyline>--}}
{{--                                                <polyline x-show="isOpen()" points="18 15 12 9 6 15"></polyline>--}}
{{--                                            </svg>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div x-show="isOpen()" class="absolute mt-14 max-h-72 shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">--}}
{{--                                <div class="flex flex-col w-full">--}}
{{--                                    <template x-for="(option, index) in filteredOptions()" :key="index">--}}
{{--                                        <div @click="onOptionClick(index)" :class="classOption(option.login.uuid, index)" :aria-selected="focusedOptionIndex === index">--}}
{{--                                            <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">--}}
{{--                                                <div class="w-6 flex flex-col items-center">--}}
{{--                                                    <div class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full "><img class="rounded-full" alt="A" x-bind:src="option.picture.thumbnail"> </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="w-full items-center flex">--}}
{{--                                                    <div class="mx-2 -mt-1"><span x-text="option.name.first + ' ' + option.name.last"></span>--}}
{{--                                                        <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500" x-text="option.email"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </template>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>
</x-app-layout>

<script>
    function selectConfigs() {
        return {
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
            selectedName() { return this.selected ? this.selected.name.first + ' ' + this.selected.name.last : this.filter; },
            classOption(id, index) {
                const isSelected = this.selected ? (id == this.selected.login.uuid) : false;
                const isFocused = (index == this.focusedOptionIndex);
                return {
                    'cursor-pointer w-full border-gray-100 border-b hover:bg-blue-50': true,
                    'bg-blue-100': isSelected,
                    'bg-blue-50': isFocused
                };
            },
            fetchOptions() {
                fetch('https://randomuser.me/api/?results=10')
                    .then(response => response.json())
                    .then(data => this.options = data);
            },
            filteredOptions() {
                return this.options
                    ? this.options.results.filter(option => {
                        return (option.name.first.toLowerCase().indexOf(this.filter) > -1)
                            || (option.name.last.toLowerCase().indexOf(this.filter) > -1)
                            || (option.email.toLowerCase().indexOf(this.filter) > -1)
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
                if (this.selected && this.selected.login.uuid == selected.login.uuid) {
                    this.filter = '';
                    this.selected = null;
                }
                else {
                    this.selected = selected;
                    this.filter = this.selectedName();
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
        }
    }

    function handler() {
        return {
            fields: [],
            addNewField() {
                this.fields.push({
                    txt1: '',
                    txt2: '',
                    txt3: ''
                });
            },
            removeField(index) {
                this.fields.splice(index, 1);
            }
        }
    }
</script>

