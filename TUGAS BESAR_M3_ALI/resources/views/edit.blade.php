<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - Katalog</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background-color: #f1f5f9; color: #1e293b; padding: 50px 15px; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); }
        .header { margin-bottom: 25px; text-align: center; }
        .header h2 { font-size: 24px; color: #0f172a; margin-bottom: 5px;}
        .field { margin-bottom: 15px; }
        .field label { display: block; margin-bottom: 6px; font-size: 13px; font-weight: bold; }
        .field input, .field select { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; }
        .field input:focus, .field select:focus { outline: none; border-color: #2563eb; }
        .field input[readonly] { background-color: #e2e8f0; cursor: not-allowed; }
        .dua-kolom { display: flex; gap: 10px; }
        .dua-kolom .field { flex: 1; }
        .btn-grup { display: flex; gap: 10px; margin-top: 20px; }
        .btn-simpan { flex: 1; padding: 12px; background-color: #2563eb; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        .btn-simpan:hover { background-color: #1d4ed8; }
        .btn-batal { flex: 1; padding: 12px; background-color: #e2e8f0; color: #475569; text-decoration: none; border-radius: 6px; font-weight: bold; text-align: center; display: inline-block;}
        .btn-batal:hover { background-color: #cbd5e1; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Edit Data Barang</h2>
            <p>Perbarui informasi barang di bawah ini</p>
        </div>

       
        <form action="{{ route('katalog.update', $barang->sku) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="kodeBarang">Kode Barang (SKU) - <i>Tidak dapat diubah</i></label>
                
                <input type="text" id="kodeBarang" name="kodeBarang" value="{{ $barang->sku }}" readonly>
            </div>

            <div class="field">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" id="namaBarang" name="namaBarang" value="{{ $barang->nama_barang }}" required>
            </div>

            <div class="dua-kolom">
                <div class="field">
                    <label for="kategoriBarang">Kategori</label>
                    <select id="kategoriBarang" name="kategoriBarang" required>
                        <option value="Elektronik" {{ $barang->kategori == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="Perkakas" {{ $barang->kategori == 'Perkakas' ? 'selected' : '' }}>Perkakas</option>
                        <option value="Material" {{ $barang->kategori == 'Material' ? 'selected' : '' }}>Material</option>
                    </select>
                </div>

                <div class="field">
                    <label for="satuanUnit">Satuan</label>
                    <select id="satuanUnit" name="satuanUnit" required>
                        <option value="Pcs" {{ $barang->satuan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="Box" {{ $barang->satuan == 'Box' ? 'selected' : '' }}>Box</option>
                        <option value="Unit" {{ $barang->satuan == 'Unit' ? 'selected' : '' }}>Unit</option>
                        <option value="Pallet" {{ $barang->satuan == 'Pallet' ? 'selected' : '' }}>Pallet</option>
                    </select>
                </div>
            </div>

            <div class="btn-grup">
                <a href="{{ route('katalog.index') }}" class="btn-batal">Batal</a>
                <button type="submit" class="btn-simpan">Perbarui Barang</button>
            </div>
        </form>
    </div>

</body>
</html>