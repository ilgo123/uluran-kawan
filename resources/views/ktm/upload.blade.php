<div class="container mt-5">
    <h2>Upload KTM (Kartu Tanda Mahasiswa)</h2>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('ktm.submit') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="student_id_card" class="form-label">Unggah Gambar KTM</label>
            <input class="form-control @error('student_id_card') is-invalid @enderror" type="file"
                name="student_id_card" accept="image/*" required>

            @error('student_id_card')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if (auth()->user()->student_id_card_path)
            <p>File KTM saat ini:</p>
            <img src="{{ asset('storage/' . auth()->user()->student_id_card_path) }}" alt="KTM" width="200"
                class="mb-3">
        @endif

        <button type="submit" class="btn btn-primary">Upload KTM</button>
    </form>
</div>
