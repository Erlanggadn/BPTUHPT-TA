@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Sapi ke Kegiatan Kandang</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah</h5>
                        <form action="{{ route('tambahSapi', $id_kegiatan) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_kegiatan" value="{{ $id_kegiatan }}">
                            <div class="mb-3">
                                <label for="search-sapi" class="form-label">Cari Sapi</label>
                                <input type="text" class="form-control" id="search-sapi" placeholder="Cari Sapi...">
                            </div>
                            <div class="mb-3">
                                <label for="kode_sapi" class="form-label">Pilih Sapi</label>
                                <div id="sapi-list" class="form-control" style="height: 200px; overflow-y: scroll;">
                                    @foreach($sapis as $sapi)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kode_sapi[]"
                                            value="{{ $sapi->id }}" id="sapi-{{ $sapi->id }}"
                                            data-jenis="{{ $sapi->jenis }}">
                                        <label class="form-check-label" for="sapi-{{ $sapi->id }}">
                                            {{ $sapi->id }} - {{ $sapi->jenis }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_sapi" class="form-label">Jenis Sapi</label>
                                <input type="text" class="form-control" id="jenis_sapi" name="jenis_sapi" readonly>
                            </div>
                            <a href="{{ route('detailkegiatan', $id_kegiatan) }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Template Main JS File -->
<script src="{{ asset('js/main.js') }}"></script>
<script>
    document.getElementById('search-sapi').addEventListener('input', function () {
        var searchValue = this.value.toLowerCase();
        var sapiList = document.getElementById('sapi-list').getElementsByClassName('form-check');
        for (var i = 0; i < sapiList.length; i++) {
            var label = sapiList[i].getElementsByTagName('label')[0];
            var labelText = label.innerText.toLowerCase();
            sapiList[i].style.display = labelText.includes(searchValue) ? '' : 'none';
        }
    });

    var sapiCheckboxes = document.querySelectorAll('input[name="kode_sapi[]"]');
    sapiCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                document.getElementById('jenis_sapi').value = this.getAttribute('data-jenis');
                sapiCheckboxes.forEach(function (cb) {
                    if (cb !== checkbox) {
                        cb.checked = false;
                    }
                });
            } else {
                document.getElementById('jenis_sapi').value = '';
            }
        });
    });

</script>
