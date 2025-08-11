@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="fas fa-shopping-cart me-2"></i> Belanja Produk
        </h4>
    </div>

    @if(session('success'))
        <div class="alert" style="background-color: #0ba100; color: #1a3d2f; border: 1px solid #17d61e;">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($products as $product)
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ asset('storage/' . $product->photo) }}"
                         alt="{{ $product->nama }}"
                         class="card-img-top"
                         style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold">{{ $product->nama }}</h5>
                        <p class="text-muted small mb-2">{{ $product->deskripsi }}</p>

                        <ul class="list-unstyled small mb-3">
                            <li>💰 <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></li>
                            <li>🏦 Rekening: <strong>{{ $product->no_rekening }}</strong></li>
                        </ul>

                        <form action="{{ route('Peserta.belanja.pesan', $product->id) }}" method="POST" class="mt-auto">
                            @csrf

                            <div class="mb-2">
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="Email (opsional)">
                            </div>

                            <div class="mb-2">
                                <input 
                                    type="number" 
                                    name="jumlah" 
                                    class="form-control form-control-sm jumlah-input" 
                                    data-id="{{ $product->id }}"
                                    data-price="{{ $product->price }}"
                                    placeholder="Jumlah Pesan" 
                                    value="1"
                                    min="1" 
                                    max="{{ $product->stock }}"
                                    required
                                >

                            </div>

                            <div class="mb-2">
                                <textarea 
                                    name="alamat" 
                                    rows="2"
                                    class="form-control form-control-sm" 
                                    placeholder="Alamat Lengkap Pengiriman"
                                    required
                                ></textarea>
                            </div>

                            <div class="mb-2 small">
                                Total Harga: 
                                <strong class="text-success" id="total-{{ $product->id }}">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </strong>
                            </div>

                            <input type="hidden" name="total_harga" id="hidden-total-{{ $product->id }}" value="{{ $product->price }}">

                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                <i class="fas fa-shopping-bag me-1"></i> Pesan Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-4">
                    <i class="fas fa-info-circle me-2"></i> Belum ada produk yang tersedia saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jumlahInputs = document.querySelectorAll('.jumlah-input');

        jumlahInputs.forEach(input => {
            input.addEventListener('input', function () {
                const productId = this.dataset.id;
                const hargaSatuan = parseInt(this.dataset.price);
                const jumlah = parseInt(this.value) || 0;
                const total = jumlah * hargaSatuan;

                const totalDisplay = document.getElementById(`total-${productId}`);
                const hiddenInput = document.getElementById(`hidden-total-${productId}`);

                if (totalDisplay) {
                    totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
                }

                if (hiddenInput) {
                    hiddenInput.value = total;
                }
            });
        });
    });
</script>


