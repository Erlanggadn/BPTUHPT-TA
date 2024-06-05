<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Kegiatan dan Status Kegiatan Kandang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('updatekegiatankandang', $kegiatanKandang->id_kegiatan) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="kegiatan" class="col-form-label">Uraian Kegiatan</label>
                        <textarea name="kegiatan" class="form-control" id="kegiatan" rows="4"
                            required>{{ $kegiatanKandang->kegiatan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="col-form-label">Status</label>
                        <select name="status" class="form-select" id="status" required>
                            <option value="Diproses">
                                Diproses</option>
                            <option value="Selesai">
                                Selesai</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
