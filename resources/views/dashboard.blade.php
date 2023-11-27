<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14 mb-4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-6 flex justify-between text-2xl w-full">
                    <div class="font-semibold text-gray-600">
                        @canany(['admin', 'staff'])
                        Tabungan Masyarakat yang Terismpan
                        @endcanany
                        @can('member')
                        Jumlah Tabungan
                        @endcan
                    </div>
                    <div class="text-right font-semibold text-gray-600">
                        Rp. {{ $saldo_kas }}
                    </div>
                </div>
            </div>

            <div class="py-4 flex flex-wrap gap-y-4 gap-x-2">
                <div style="align-self: flex-start" class="w-1/4 bg-white rounded-lg shadow-md">
                    <div class="bg-lime-400 rounded-t-lg">
                        @if(Auth::user()->role == 'member')
                        <h1 class="text-center text-gray-700 font-semibold text-2xl py-4 px-4">{{ ucwords(strtolower(Auth::user()->name)) }}</h1>
                        @else
                        <div class="text-center text-gray-700 font-semibold text-2xl py-4 px-4">
                            <p>Bank Sampah</p>
                            <p>Griya Cibinong Indah</p>
                        </div>
                        @endif
                    </div>
                    @if(Auth::user()->role == 'member')
                        <table class="block mx-4 my-4">
                            <tr>
                                <td class="max-w-[200px] text-left align-top pr-4">Alamat</td>
                                <td class="max-w-[200px] align-top">:</td>
                                <td class="max-w-[200px] px-2 max-w-sm break-words">{{ Auth::user()->anggota->alamat }}</td>
                            </tr>
                            <tr>
                                <td class="max-w-[200px] text-left align-top pr-4">No NIK</td>
                                <td class="max-w-[200px] align-top">:</td>
                                <td class="max-w-[200px] px-2">{{ Auth::user()->anggota->no_nik }}</td>
                            </tr>
                            <tr>
                                <td class="max-w-[200px] text-left align-top pr-4">Email</td>
                                <td class="max-w-[200px] align-top">:</td>
                                <td class="max-w-[200px] px-2">{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <td class="max-w-[200px] text-left align-top pr-4">Telepon</td>
                                <td class="max-w-[200px] align-top">:</td>
                                <td class="max-w-[200px] px-2">{{ Auth::user()->anggota->nomor_telepon }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="flex justify-center mt-2 mb-6">
                            <svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class="text-green-500 mx-2">
                                    <path d="M21.82,15.42L19.32,19.75C18.83,20.61 17.92,21.06 17,21H15V23L12.5,18.5L15,14V16H17.82L15.6,12.15L19.93,9.65L21.73,12.77C22.25,13.54 22.32,14.57 21.82,15.42M9.21,3.06H14.21C15.19,3.06 16.04,3.63 16.45,4.45L17.45,6.19L19.18,5.19L16.54,9.6L11.39,9.69L13.12,8.69L11.71,6.24L9.5,10.09L5.16,7.59L6.96,4.47C7.37,3.64 8.22,3.06 9.21,3.06M5.05,19.76L2.55,15.43C2.06,14.58 2.13,13.56 2.64,12.79L3.64,11.06L1.91,10.06L7.05,10.14L9.7,14.56L7.97,13.56L6.56,16H11V21H7.4C6.47,21.07 5.55,20.61 5.05,19.76Z" />
                                </svg>
                        </div>
                        <table class="block mx-4 my-4">
                            <tr>
                                <td class="max-w-[200px] text-left align-top pr-4">Jumlah Masyarakat</td>
                                <td class="max-w-[200px] align-top">:</td>
                                <td class="max-w-[200px] px-2 max-w-sm break-words">{{$jumlah_anggota}}</td>
                            </tr>
                        </table>
                    @endif
                </div>

                <div class="grow w-1/2">
                    <div class="bg-white rounded-lg shadow-md mb-2">
                        <div class="px-4 py-4">
                            <div class="font-semibold text-xl text-gray-600">Rekap Bulan Ini</div>
                            <div class="flex ">
                                <div class="text-gray-600 text-md w-1/2">Masuk Tabungan : {{$transaksi_masuk}}</div>
                                <div class="text-gray-600 text-md w-1/2">Tarik Tabungan : {{$transaksi_keluar}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="h-fit bg-white rounded-lg shadow-md mt-2">
                        <div class="px-4 py-4">
                            <div class="font-semibold text-xl text-gray-600 border-b-4">Histori Transaksi</div>
                            <div class="overflow-x-auto">
                                <table class="px-4 text-sm w-full text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Kode Transaksi
                                        </th>
                                        @canany(['staff', 'admin'])
                                            <th scope="col" class="px-6 py-3">
                                                Nama Masyarakat
                                            </th>
                                        @endcanany
                                        <th scope="col" class="px-6 py-3">
                                            Alur Transaksi
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Jumlah
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transaksi as $item)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">
                                                {{ $item->kode_transaksi }}
                                            </td>
                                            @canany(['staff', 'admin'])
                                                <td class="px-6 py-4">
                                                    {{ $item->masyarakat->nama }}
                                                </td>
                                            @endcanany
                                            <td class="px-6 py-4">
                                                Transaksi {{ $item->arus_transaksi }}
                                            </td>
                                            <td class="px-6 py-4">
                                                Rp. {{ $item->jumlah_uang }}
                                            </td>
                                            <td>
                                                <a href="http://localhost:8080/histori-transaksi/detail?kode={{ $item->kode_transaksi }}" class="text-indigo-600 hover:underline">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
