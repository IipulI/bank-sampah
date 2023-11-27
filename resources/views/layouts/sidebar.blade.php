<aside id="logo-sidebar" class="fixed top-0 left-0 z-30 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar" aria-hidden="true">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class="bac nx rz um">
                        <path d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z" />
                    </svg>

                    <span class="ml-3">Dashboard</span>
                    @else
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="bac nx rz um">
                        <path d="M20 2C21.1 2 22 2.9 22 4V20C22 21.1 21.1 22 20 22H19V23H15V22H9V23H5V22H4C2.9 22 2 21.1 2 20V4C2 2.9 2.9 2 4 2H20M17 12C17 11 16.7 10 16.2 9.2L17.7 7.7L16.3 6.3L14.8 7.8C14 7.3 13 7 12 7C11 7 10 7.3 9.2 7.8L7.8 6.3L6.3 7.8L7.8 9.3C7.3 10 7 11 7 12C7 13 7.3 14 7.8 14.8L6.3 16.3L7.8 17.7L9.3 16.2C10 16.7 11 17 12 17C13 17 14 16.7 14.8 16.2L16.3 17.7L17.7 16.3L16.2 14.8C16.7 14 17 13 17 12M12 9C13.7 9 15 10.3 15 12C15 13.7 13.7 15 12 15C10.3 15 9 13.7 9 12C9 10.3 10.3 9 12 9M12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14Z" />
                    </svg>

                    <span class="ml-3">Tabungan</span>
                    @endif
                </x-sidebar-link>
            </li>
            @canany(['admin'])
            <li>
                <x-sidebar-link :href="route('staffs')" :active="request()->routeIs('staffs')">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class="bac nx rz um">
                        <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M17.13,17C15.92,18.85 14.11,20.24 12,20.92C9.89,20.24 8.08,18.85 6.87,17C6.53,16.5 6.24,16 6,15.47C6,13.82 8.71,12.47 12,12.47C15.29,12.47 18,13.79 18,15.47C17.76,16 17.47,16.5 17.13,17Z" />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Staff</span>
                </x-sidebar-link>
            </li>
            @endcan
            @canany(['admin', 'staff'])
            <li>
                <x-sidebar-link :href="route('anggota')" :active="request()->routeIs('anggota')">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class="bac nx rz um">
                        <path d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z" />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Masyarakat</span>
                </x-sidebar-link>
            </li>
            @endcanany
            {{--            @canany(['admin', 'staff'])--}}
            {{--                <li>--}}
            {{--                    <x-sidebar-link :href="route('request-tarik-dana')" :active="request()->routeIs('request-tarik-dana')">--}}
            {{--                        <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class="bac nx rz um">--}}
            {{--                            <path d="M17 3H7C4.79 3 3 4.79 3 7V17C3 19.21 4.79 21 7 21H19C20.11 21 21 20.11 21 19V9C21 7.9 20.11 7 19 7V5C19 3.9 18.11 3 17 3M17 5V7H7C6.27 7 5.59 7.2 5 7.54V7C5 5.9 5.9 5 7 5M15.5 15.5C14.67 15.5 14 14.83 14 14S14.67 12.5 15.5 12.5 17 13.17 17 14 16.33 15.5 15.5 15.5Z" />--}}
            {{--                        </svg>--}}

            {{--                        <span class="flex-1 ml-3 whitespace-nowrap">Tabungan Masyarakat</span>--}}
            {{--                    </x-sidebar-link>--}}
            {{--                </li>--}}
            {{--            @endcanany--}}
            @canany(['admin', 'staff'])
                <li>
                    <x-sidebar-link :href="route('request-tarik-dana')" :active="request()->routeIs('request-tarik-dana')">
                        <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class="bac nx rz um">
                            <path d="M3 8C2.45 8 2 7.55 2 7S2.45 6 3 6H5.54C5.19 6.6 5 7.29 5 8H3M5 13H2C1.45 13 1 12.55 1 12S1.45 11 2 11H5V13M1 18C.448 18 0 17.55 0 17S.448 16 1 16H5C5 16.71 5.19 17.4 5.54 18H1M21 6H9C7.89 6 7 6.89 7 8V16C7 17.11 7.89 18 9 18H21C22.11 18 23 17.11 23 16V8C23 6.89 22.11 6 21 6M21 12H9V9H21V12Z" />
                        </svg>

                        <span class="flex-1 ml-3 whitespace-nowrap">Request Tarik Tabungan</span>
                    </x-sidebar-link>
                </li>
            @endcanany
            @canany(['admin', 'staff'])
            <li>
                <x-sidebar-link :href="route('tipe-sampah')" :active="request()->routeIs('tipe-sampah')">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"  aria-hidden="true" class="bac nx rz um">
                        <path d="M5.12,5H18.87L17.93,4H5.93L5.12,5M20.54,5.23C20.83,5.57 21,6 21,6.5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V6.5C3,6 3.17,5.57 3.46,5.23L4.84,3.55C5.12,3.21 5.53,3 6,3H18C18.47,3 18.88,3.21 19.15,3.55L20.54,5.23M6,18H12V15H6V18Z" />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Tipe Sampah</span>
                </x-sidebar-link>
            </li>
            @endcanany
            @canany(['admin', 'staff'])
            <li>
                <x-sidebar-link :href="route('setor-sampah')" :active="request()->routeIs('setor-sampah')">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class="bac nx rz um">
                        <path d="M20.54,5.23C20.83,5.57 21,6 21,6.5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V6.5C3,6 3.17,5.57 3.46,5.23L4.84,3.55C5.12,3.21 5.53,3 6,3H18C18.47,3 18.88,3.21 19.15,3.55L20.54,5.23M5.12,5H18.87L17.93,4H5.93L5.12,5M12,9.5L6.5,15H10V17H14V15H17.5L12,9.5Z" />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Setor Sampah</span>
                </x-sidebar-link>
            </li>
            @endcanany
            <li>
                <x-sidebar-link :href="route('histori-transaksi')" :active="request()->routeIs('histori-transaksi')">
                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="bac nx rz um">
                        <path d="M3,22L4.5,20.5L6,22L7.5,20.5L9,22L10.5,20.5L12,22L13.5,20.5L15,22L16.5,20.5L18,22L19.5,20.5L21,22V2L19.5,3.5L18,2L16.5,3.5L15,2L13.5,3.5L12,2L10.5,3.5L9,2L7.5,3.5L6,2L4.5,3.5L3,2M18,9H6V7H18M18,13H6V11H18M18,17H6V15H18V17Z" />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Histori Transaksi</span>
                </x-sidebar-link>
            </li>
        </ul>
    </div>
</aside>
