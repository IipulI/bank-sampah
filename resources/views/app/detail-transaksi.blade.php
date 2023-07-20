<x-app-layout>
    {{--    <x-slot name="header">--}}
    {{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
    {{--            {{ __('Dashboard') }}--}}
    {{--        </h2>--}}
    {{--    </x-slot>--}}

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">

            <div class="flex flex-wrap gap-x-2 gap-y-4">
                <div class="grow bg-white rounded-lg shadow-md px-4 py-4 w-80 h-fit">
                    <div class="text-2xl font-semibold text-gray-600 border-b-4">Detail Transaksi</div>
                    <table class="mx-2 my-2">
                        <tr>
                            <td class="text-left align-top pr-4">Kode Transaksi</td>
                            <td class="align-top">:</td>
                            <td class="px-2">{{ $transaksi->kode_transaksi }}</td>
                        </tr>
                        <tr>
                            <td class="text-left align-top pr-4">Nama Anggota</td>
                            <td class="align-top">:</td>
                            <td class="px-2">{{ $transaksi->anggota->nama }}</td>
                        </tr>
                        <tr>
                            <td class="text-left align-top pr-4">Tanggal Transaksi</td>
                            <td class="align-top">:</td>
                            <td class="px-2">{{ $transaksi->tanggal_transaksi }}</td>
                        </tr>
                        <tr>
                            <td class="text-left align-top pr-4">Jumlah Uang</td>
                            <td class="align-top">:</td>
                            <td class="px-2">{{ $transaksi->jumlah_uang }}</td>
                        </tr>
                        <tr>
                            <td class="text-left align-top pr-4">Arus Transaksi</td>
                            <td class="align-top">:</td>
                            <td class="px-2 max-w-md break-words">{{ $transaksi->arus_transaksi }}</td>
                        </tr>
                        <tr>
                            <td class="text-left align-top pr-4">Staff Penginput</td>
                            <td class="align-top">:</td>
                            <td class="px-2">{{ $transaksi->staff->nama }}</td>
                        </tr>
                    </table>
                </div>

                <div class="grow bg-white rounded-lg shadow-md w-1/2 h-fit">
                    <div class="px-4 py-4">
                        <div class="font-semibold text-2xl text-gray-600 border-b-4 w-full">List Barang</div>

                        <table class="px-4 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama Barang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Timbangan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah Uang
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transaksi->tipeSampah as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ $item->nama }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->pivot->timbangan . ' ' . $item->satuan }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp. {{ $item->pivot->harga }}
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

</x-app-layout>
