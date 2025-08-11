@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="fas fa-calendar me-2"></i> Kalender Kegiatan
        </h4>
    </div>
     <div class="card">
        <div class="card-body p-3">
            <!-- Modal Kegiatan -->
            <div class="modal fade" id="modalKegiatan" tabindex="-1" aria-labelledby="modalKegiatanLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="formKegiatan">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalKegiatanLabel">Tambah Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                        <input type="hidden" id="kegiatanId">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" id="judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        <input type="hidden" id="tanggal">
                        </div>
                      <div class="modal-footer">
                            <button type="button" class="btn btn-danger d-none" id="btnHapus">Hapus</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div id="calendar" class="w-100"></div> 
        </div>
    </div>
    
</div>
@endsection



@section('scripts')

<style>
    #calendar {
    width: 100% !important;
    max-width: 100%;
    overflow-x: auto;
    padding: 0;
    }

    .fc {
        font-size: 0.875rem; 
    }

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const modal = new bootstrap.Modal(document.getElementById('modalKegiatan'));
    const form = document.getElementById('formKegiatan');
    const judulInput = document.getElementById('judul');
    const deskripsiInput = document.getElementById('deskripsi');
    const tanggalInput = document.getElementById('tanggal');
    const kegiatanIdInput = document.getElementById('kegiatanId');
    const btnSimpan = document.getElementById('btnSimpan');

    let currentAction = 'create';

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: '{{ route("admin.kegiatan.events") }}',

      dateClick: function(info) {
            currentAction = 'create';
            judulInput.value = '';
            deskripsiInput.value = '';
            tanggalInput.value = info.dateStr;
            kegiatanIdInput.value = '';
            document.getElementById('modalKegiatanLabel').textContent = 'Tambah Kegiatan';
            btnSimpan.textContent = 'Simpan';
            btnHapus.classList.add('d-none');
            modal.show();
        },

        eventClick: function(info) {
            currentAction = 'edit';
            const event = info.event;

            kegiatanIdInput.value = event.id;
            judulInput.value = event.title;
            deskripsiInput.value = event.extendedProps.deskripsi || '';
            tanggalInput.value = event.startStr;
            document.getElementById('modalKegiatanLabel').textContent = 'Edit Kegiatan';
            btnSimpan.textContent = 'Update';
            btnHapus.classList.remove('d-none');
            modal.show();
        }

    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const id = kegiatanIdInput.value;
        const url = currentAction === 'edit'
            ? `{{ route('admin.kegiatan.update', ':id') }}`.replace(':id', id)
            : `{{ route('admin.kegiatan.store') }}`;

        const method = currentAction === 'edit' ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                judul: judulInput.value,
                deskripsi: deskripsiInput.value,
                tanggal: tanggalInput.value
            })
        })
        .then(res => res.json())
        .then(() => {
            calendar.refetchEvents();
            modal.hide();
            Swal.fire('Berhasil!', `Kegiatan berhasil ${currentAction === 'edit' ? 'diperbarui' : 'ditambahkan'}.`, 'success');
        });
    });


    const btnHapus = document.getElementById('btnHapus');

        btnHapus.addEventListener('click', function () {
            const id = kegiatanIdInput.value;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Tindakan ini tidak dapat dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('admin.kegiatan.destroy', ':id') }}`.replace(':id', id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    })
                    .then(() => {
                        calendar.refetchEvents();
                        modal.hide();
                        Swal.fire('Terhapus!', 'Kegiatan berhasil dihapus.', 'success');
                    });
                }
            });
        });


    calendar.render();
});
</script>


</script>
@endsection
