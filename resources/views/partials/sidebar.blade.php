@php
    function set_active($route)
    {
        return request()->is($route) ? 'active' : '';
    }
@endphp

<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.index') }}">
        <div class="sidebar-brand-text mx-3">KARISMA</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link {{ set_active('dashboard') }}" href="{{ route('home.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @if (auth()->check() && auth()->user()->role->role == 'Admin')
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Master Data</div>

        <li class="nav-item">
            <a class="nav-link {{ set_active('admin/data-user*') }}" href="{{ route('admin.data-user.index') }}">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Manajemen User</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ set_active('admin/verifikasi-user*') }}" href="{{ route('admin.verifikasi-user.index') }}">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Verifikasi User</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ set_active('admin/laporan-divisi*') }}" href="{{ route('admin.laporan-divisi.index') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan Divisi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ set_active('admin/kegiatan*') }}" href="{{ route('admin.kegiatan.index') }}">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Kalender Kegiatan</span>
            </a>
        </li>


         <!-- {{-- <li class="nav-item {{ set_active('admin/products*') }}">
            <a class="nav-link" href="{{ route('admin.products.index') }}">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Kelola Produk</span>
            </a>
        </li> --}} -->

         <!-- <li class="nav-item">
            <a class="nav-link {{ set_active('admin/verifikasi-pembayaran*') }}" href="{{ route('admin.verifikasi-pembayaran.index') }}">
                <i class="fas fa-fw fa-money-check-alt"></i>
                <span>Verifikasi Pembayaran</span>
            </a>
        </li> -->

        <li class="nav-item {{ set_active('admin/category/categories*') }}">
           <a class="nav-link" href="{{ route('admin.categories.index') }}">
               <i class="fas fa-tags me-2"></i>
               <span>Categori</span>
           </a>
       </li>

        <li class="nav-item {{ set_active('admin/program*') }}">
            <a class="nav-link" href="{{ route('admin.program.index') }}">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Program</span>
            </a>
        </li>

        <!-- <li class="nav-item {{ set_active('admin/order*') }}">
            <a class="nav-link" href="{{ route('admin.order.index') }}">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>List Order</span>
            </a>
        </li> -->

         <li class="nav-item">
            <a class="nav-link {{ set_active('admin/kontak*') }}" href="{{ route('admin.kontak.index') }}">
                <i class="fas fa-fw fa-envelope"></i>
                <span>Kontak Masuk</span>
            </a>
        </li>




    <!-- Pengurus Divisi -->
   @elseif (auth()->check() && auth()->user()->role && auth()->user()->role->role == 'Pengurus Divisi')

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Divisi</div>

        <li class="nav-item {{ set_active('Pengurus Divisi/laporan-divisi*') }}">
            <a class="nav-link" href="{{ route('pengurus.laporan-divisi.index') }}">
                <i class="fas fa-fw fa-file-signature"></i>
                <span>Laporan Divisi</span>
            </a>
        </li>

        {{-- <li class="nav-item {{ set_active('Pengurus Divisi/category/categories*') }}">
           <a class="nav-link" href="{{ route('pengurus.categories.index') }}">
               <i class="fas fa-tags me-2"></i>
               <span>Categori</span>
           </a>
       </li> --}}

        {{-- <li class="nav-item {{ set_active('Pengurus Divisi/program*') }}">
            <a class="nav-link" href="{{ route('pengurus.program.index') }}">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Program</span>
            </a>
        </li> --}}


        <li class="nav-item {{ set_active('Pengurus Divisi/raport*') }}">
            <a class="nav-link" href="{{ route('pengurus.raport.index') }}">
                <i class="fas fa-fw fa-upload"></i>
                <span>Upload Rapor</span>
            </a>
        </li>

        {{-- <li class="nav-item {{ set_active('Pengurus Divisi/amalyaumi*') }}">
            <a class="nav-link" href="{{ route('pengurus.amalyaumi.index') }}">
                <i class="fas fa-fw fa-praying-hands"></i>
                <span>Amal Yaumi Adik</span>
            </a>
        </li> --}}

        {{-- <li class="nav-item {{ set_active('Pengurus Divisi/products*') }}">
            <a class="nav-link" href="{{ route('pengurus.products.index') }}">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Kelola Produk</span>
            </a>
        </li> --}}

         {{-- <li class="nav-item">
            <a class="nav-link {{ set_active('Pengurus Divisi/verifikasi-pembayaran*') }}" href="{{ route('pengurus.verifikasi-pembayaran.index') }}">
                <i class="fas fa-fw fa-money-check-alt"></i>
                <span>Verifikasi Pembayaran</span>
            </a>
        </li> --}}

         <li class="nav-item">
            <a class="nav-link {{ set_active('Pengurus Divisi/pendaftaran*') }}" href="{{ route('pengurus.pendaftaran.index') }}">
               <i class="fas fa-list-alt me-2"></i>
                <span>Data Pendaftaran Program</span>
            </a>
        </li>

         <li class="nav-item">
            <a class="nav-link {{ set_active('pengurus/dokumentasi*') }}" href="{{ route('pengurus.dokumentasi.index') }}">
                <i class="fas fa-fw fa-images"></i>
                <span>Berita Acara</span>
            </a>
        </li>

       @elseif (auth()->check() && auth()->user()->role && auth()->user()->role->role == 'Pembina')
         <hr class="sidebar-divider">
         <div class="sidebar-heading">Monitoring</div>

            <li class="nav-item {{ set_active('Pembina/raport*') }}">
                <a class="nav-link" href="{{ route('Pembina.raport.index') }}">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Rapor Adik</span>
                </a>
            </li>

            {{-- <li class="nav-item {{ set_active('Pembina/amalyaumi*') }}">
                <a class="nav-link" href="{{ route('Pembina.amalyaumi.index') }}">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Amal Yaumi</span>
                </a>
            </li> --}}



      @elseif (auth()->check() && auth()->user()->role && auth()->user()->role->role == 'Peserta')
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Kegiatan Saya</div>

            <li class="nav-item {{ set_active('Peserta/pembayaran/riwayat*') }}">
                <a class="nav-link" href="{{ route('Peserta.pembayaran.riwayat') }}">
                    <i class="fas fa-fw fa-money-check"></i>
                    <span>Pembayaran</span>
                </a>
            </li>

            {{-- <li class="nav-item {{ set_active('Peserta/amal-yaumi*') }}">
                <a class="nav-link" href="{{ route('Peserta.amal-yaumi.index') }}">
                    <i class="fas fa-fw fa-praying-hands"></i>
                    <span>Amal Yaumi</span>
                </a>
            </li> --}}

            <li class="nav-item {{ set_active('Peserta/rapor*') }}">
                <a class="nav-link" href="{{ route('Peserta.rapor.index') }}">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Lihat Rapor</span>
                </a>
            </li>

            {{-- <li class="nav-item {{ set_active('Peserta/belanja*') }}">
                <a class="nav-link" href="{{ route('Peserta.belanja.index') }}">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Belanja Produk</span>
                </a>
            </li> --}}

            <li class="nav-item {{ set_active('Peserta/pendaftaran-program*') }}">
                <a class="nav-link" href="{{ route('Peserta.pendaftaran-program.index') }}">
                   <i class="fas fa-file-signature"></i>
                    <span>Daftar Program</span>
                </a>
            </li>
    @endif

</ul>

