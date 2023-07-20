<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-4 py-4 flex justify-between w-full">
                    <div class="font-semibold text-lg text-gray-600">
                        Jumlah Kas
                    </div>
                    <div class="text-right font-semibold text-lg text-gray-600">
                        Rp. {{ $saldo_kas }}
                    </div>
                </div>
            </div>

            <div class="py-4 flex gap-x-2">
                @canany(['admin', 'staff'])
                <div class="flex flex-col gap-y-4 w-1/4">
                    <div class="bg-white rounded-lg shadow-md ">
                        <div class="px-4 py-4">
                            <div class="font-semibold text-2xl text-gray-600 border-b-4 w-full">Jumlah anggota</div>
                            <div class="flex items-center justify-around mt-4">
                                <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                                    <title>account-group</title>
                                    <path d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z" />
                                </svg>

                                <div class="font-semibold text-5xl text-gray-600">{{ $jumlah_anggota }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md ">
                        <div class="px-4 py-4">
                            <div class="font-semibold text-2xl text-gray-600 border-b-4 w-full">Jumlah Tipe Sampah </div>
                            <div class="flex items-center justify-around mt-4">
                                <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                                    <title>account-group</title>
                                    <path d="M5.12,5H18.87L17.93,4H5.93L5.12,5M20.54,5.23C20.83,5.57 21,6 21,6.5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V6.5C3,6 3.17,5.57 3.46,5.23L4.84,3.55C5.12,3.21 5.53,3 6,3H18C18.47,3 18.88,3.21 19.15,3.55L20.54,5.23M6,18H12V15H6V18Z"></path>
                                </svg>

                                <div class="font-semibold text-5xl text-gray-600">{{ $jumlah_tipe_sampah }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md ">
                        <div class="px-4 py-4">
                            <div class="font-semibold text-2xl text-gray-600 border-b-4 w-full">Jumlah Transaksi Masuk </div>
                            <div class="flex items-center justify-around mt-4">
                                <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                                    <title>receipt-in</title>
                                    <path d="M19.5 3.5L18 2L16.5 3.5L15 2L13.5 3.5L12 2L10.5 3.5L9 2L7.5 3.5L6 2L4.5 3.5L3 2V22L4.5 20.5L6 22L7.5 20.5L9 22L10.5 20.5L12 22L13.26 20.74C13.09 20.18 13 19.59 13 19C13 18.32 13.12 17.64 13.34 17H6V15H14.53C15.67 13.73 17.29 13 19 13C19.68 13 20.36 13.12 21 13.34V2L19.5 3.5M18 13H6V11H18V13M18 9H6V7H18V9M18 18V16L15 19L18 22V20H22V18H18Z" />
                                </svg>

                                <div class="font-semibold text-5xl text-gray-600">{{ $jumlah_transaksi_masuk }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany

                @canany(['admin', 'staff'])
                <div class="flex flex-col gap-y-4 w-1/4">
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="px-4 py-4">
                            <div class="font-semibold text-2xl text-gray-600 border-b-4 w-full">Jumlah Staff</div>
                            <div class="flex items-center justify-around mt-4">
                                <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                                    <title>shield-account</title>
                                    <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M17.13,17C15.92,18.85 14.11,20.24 12,20.92C9.89,20.24 8.08,18.85 6.87,17C6.53,16.5 6.24,16 6,15.47C6,13.82 8.71,12.47 12,12.47C15.29,12.47 18,13.79 18,15.47C17.76,16 17.47,16.5 17.13,17Z" />
                                </svg>

                                <div class="font-semibold text-5xl text-gray-600">{{ $jumlah_staff }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="px-4 py-4">
                            <div class="font-semibold text-2xl text-gray-600 border-b-4 w-full">Jumlah Sampah Masuk</div>
                            <div class="flex items-center justify-around mt-4">
                                <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                                    <title>shield-account</title>
                                    <path d="M20.54,5.23C20.83,5.57 21,6 21,6.5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V6.5C3,6 3.17,5.57 3.46,5.23L4.84,3.55C5.12,3.21 5.53,3 6,3H18C18.47,3 18.88,3.21 19.15,3.55L20.54,5.23M5.12,5H18.87L17.93,4H5.93L5.12,5M12,9.5L6.5,15H10V17H14V15H17.5L12,9.5Z"></path>
                                </svg>

                                <div class="font-semibold text-5xl text-gray-600">{{ $jumlah_sampah_masuk }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="px-4 py-4">
                            <div class="font-semibold text-2xl text-gray-600 border-b-4 w-full">Jumlah Transaksi Keluar</div>
                            <div class="flex items-center justify-around mt-4">
                                <svg width="70" height="70" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                                    <title>shield-account</title>
                                    <path d="M19.5 3.5L18 2L16.5 3.5L15 2L13.5 3.5L12 2L10.5 3.5L9 2L7.5 3.5L6 2L4.5 3.5L3 2V22L4.5 20.5L6 22L7.5 20.5L9 22L10.5 20.5L12 22L13.26 20.74C13.09 20.18 13 19.59 13 19C13 18.32 13.12 17.64 13.34 17H6V15H14.53C15.67 13.73 17.29 13 19 13C19.68 13 20.36 13.12 21 13.34V2L19.5 3.5M18 13H6V11H18V13M18 9H6V7H18V9M19 22V20H15V18H19V16L22 19L19 22Z" />
                                </svg>


                                <div class="font-semibold text-5xl text-gray-600">{{ $jumlah_transaksi_keluar }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany

                <div class="grow h-fit bg-white rounded-lg shadow-md w-1/2">
                    <div class="px-4 py-4">
                        <div class="font-semibold text-2xl text-gray-600 border-b-4 w-full">Histori Transaksi</div>
                            <table class="px-4 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Kode Transaksi
                                    </th>
                                    @canany(['staff', 'admin'])
                                    <th scope="col" class="px-6 py-3">
                                        Nama Anggota
                                    </th>
                                    @endcanany
                                    <th scope="col" class="px-6 py-3">
                                        Alur Transaksi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jumlah
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
                                            {{ $item->anggota->nama }}
                                        </td>
                                        @endcanany
                                        <td class="px-6 py-4">
                                            Transaksi {{ $item->arus_transaksi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp. {{ $item->jumlah_uang }}
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

</x-app-layout>
