<x-app-layout>
    {{--    <x-slot name="header">--}}
    {{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
    {{--            {{ __('Dashboard') }}--}}
    {{--        </h2>--}}
    {{--    </x-slot>--}}

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">

            <div class="bg-white rounded-md shadow-md mb-4">
                <div class="flex justify-between px-4 py-4 text-2xl font-semibold text-gray-600">
                    <span>Jumlah Tabungan</span>
                    <span>Rp. {{ $anggota->tabungan->jumlah_uang != null ? $anggota->tabungan->jumlah_uang : '0' }}</span>
                </div>
            </div>

            <div class="flex flex-wrap gap-x-2 gap-y-4">
                <div class="grow bg-white rounded-lg shadow-md px-4 py-4 w-80 h-fit">
                    <div class="text-2xl font-semibold text-gray-600 border-b-4">Profil Masyarakat</div>
                    <table class="mx-2 my-2">
                        <tr>
                            <td class="text-left align-top pr-4">Nama</td>
                            <td class="align-top">:</td>
                            <td class="px-2">{{ $anggota->nama }}</td>
                        </tr>
                        <tr>
                            <td class="text-left align-top pr-4">No NIK</td>
                            <td class="align-top">:</td>
                            <td class="px-2">{{ $anggota->no_nik }}</td>
                        </tr>
                        <tr>
                            <td class="text-left align-top pr-4">Email</td>
                            <td class="align-top">:</td>
                            <td class="px-2">{{ $anggota->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-left align-top pr-4">Alamat</td>
                            <td class="align-top">:</td>
                            <td class="px-2 max-w-sm break-words">{{ $anggota->alamat }}</td>
                        </tr>
                        <tr>
                            <td class="text-left align-top pr-4">Telepon</td>
                            <td class="align-top">:</td>
                            <td class="px-2">{{ $anggota->nomor_telepon }}</td>
                        </tr>
                    </table>
                </div>

                <div class="grow bg-white rounded-lg shadow-md w-1/2 h-fit">
                    <div class="px-4 py-4">
                        <div class="font-semibold text-2xl text-gray-600 border-b-4 w-full">Histori Transaksi</div>

                        <table class="px-4 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Kode Transaksi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Alur Transaksi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Detail
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($anggota->transaksi as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ $item->kode_transaksi }}
                                </td>
                                <td class="px-6 py-4">
                                    Transaksi {{ $item->arus_transaksi }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp. {{ $item->jumlah_uang }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="http://localhost:8080/histori-transaksi/detail?kode={{ $item->kode_transaksi }}" class="text-indigo-600">
                                        Detail
                                    </a>
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
