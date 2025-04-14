<x-layout>
    <div class="pagetitle">
        <h1>Halaman Dashboard</h1>
           <nav>
               <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{route('petugas.dashboard')}}">Dashboard</a></li>
                   <li class="breadcrumb-item active">Dashboard petugas</li>
               </ol>
           </nav>
       </div>

       <x-alert-success></x-alert-success>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-light mt-4"> {{-- tambahin mt-4 di sini --}}
                    <div class="card-body text-center py-5 px-4">
                        <h3 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>

                        <div class="card p-4 bg-light border-0 shadow-sm">
                            <h5 class="text-muted mb-2">Total Penjualan Hari Ini</h5>
                            <h2 class="fw-bold mb-3">{{ $totalPenjualanHariIni }}</h2>
                            <p class="text-muted mb-3">Jumlah total penjualan yang terjadi hari ini.</p>
                            <hr>
                            <p class="text-muted mb-0">Terakhir diperbarui: {{ $waktuUpdate }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
