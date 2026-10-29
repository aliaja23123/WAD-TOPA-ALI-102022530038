<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Barang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background-color: #f1f5f9; color: #1e293b; padding: 50px 15px; }
        .container { max-width: 1075px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .header h1 { font-size: 26px; color: #0f172a; }
        .header p { font-size: 15px; color: #64748b; margin-top: 5px; }
        .btn-tambah { background-color: #2563eb; color: white; padding: 12px 18px; border-radius: 6px; font-size: 14px; font-weight: bold; text-decoration: none; }
        .btn-tambah:hover { background-color: #1d4ed8; }
        .stat-container { display: flex; gap: 15px; margin-bottom: 20px; }
        .stat-card { flex: 1; background-color: white; padding: 18px 22px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1); }
        .stat-card span { font-size: 14px; color: #64748b; display: block; margin-bottom: 7px; }
        .stat-card h2 { font-size: 25px; color: #0f172a; }
        .katalog { background-color: white; border-radius: 8px; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1); padding: 22px; }
        .katalog-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        .katalog-header h2 { font-size: 20px; }
        .search-box { padding: 10px 13px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; width: 235px; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; text-align: left; }
        th, td { padding: 13px; border-bottom: 1px solid #e2e8f0; }
        th { background-color: #f8fafc; color: #475569; }
        .sku { font-family: monospace; background: #f1f5f9; padding: 4px 7px; border-radius: 4px; }
        .badge { display: inline-block; padding: 4px 9px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-elektronik { background-color: #dbeafe; color: #1d4ed8; }
        .badge-perkakas { background-color: #fef3c7; color: #92400e; }
        .badge-material { background-color: #dcfce7; color: #166534; }
        .btn-edit, .btn-hapus { padding: 7px 12px; border-radius: 4px; font-size: 12px; text-decoration: none; display: inline-block; border: none; cursor: pointer; }
        .btn-edit { background-color: #f59e0b; color: white; }
        .btn-hapus { background-color: #ef4444; color: white; }
        .form-container { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(15, 23, 42, 0.55); justify-content: center; align-items: center; z-index: 999; }
        .form-container:target { display: flex; }
        .form-box { width: 500px; max-width: 90%; background-color: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2); }
        .form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .form-header h2 { font-size: 22px; color: #0f172a; }
        .btn-tutup { text-decoration: none; font-size: 28px; line-height: 1; color: #64748b; font-weight: bold; }
        .btn-tutup:hover { color: #ef4444; }
        .field { margin-bottom: 15px; }
        .field label { display: block; margin-bottom: 6px; font-size: 13px; font-weight: bold; }
        .field input, .field select { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; }
        .dua-kolom { display: flex; gap: 10px; }
        .dua-kolom .field { flex: 1; }
        .btn-simpan { width: 100%; padding: 11px; background-color: #2563eb; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 14px; }
    </style>
</head>
<body>

    <div class="container">
        <header class="header">
            <div>
                <h1>Katalog Barang</h1>
                <p>Kelola data barang dengan mudah</p>
            </div>
            <a href="#form-tambah" class="btn-tambah">+ Tambah Barang</a>
        </header>

        <section class="stat-container">
            <div class="stat-card">
                <span>Total Barang</span>
                <h2>{{ $totalBarang }}</h2>
            </div>
            <div class="stat-card">
                <span>Elektronik</span>
                <h2>{{ $totalElektronik }}</h2>
            </div>
            <div class="stat-card">
                <span>Perkakas</span>
                <h2>{{ $totalPerkakas }}</h2>
            </div>
        </section>

        <section class="katalog">
            <div class="katalog-header">
                <h2>Daftar Katalog Barang</h2>
                <input type="text" class="search-box" placeholder="Cari nama / SKU...">
            </div>

            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $item)
                            <tr>
                                <td><span class="sku">{{ $item->sku }}</span></td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>
                                    <span class="badge badge-{{ strtolower($item->kategori) }}">
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                <td>{{ $item->satuan }}</td>
                                <td>
                                    <a href="{{ route('katalog.edit', $item->sku) }}" class="btn-edit">Edit</a>
                                    <form action="{{ route('katalog.destroy', $item->sku) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">Belum ada data barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <section class="form-container" id="form-tambah">
        <div class="form-box">
            <div class="form-header">
                <h2>Tambah Barang</h2>
                <a href="#" class="btn-tutup">&times;</a>
            </div>

            <form action="{{ route('katalog.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="kodeBarang">Kode Barang (SKU)</label>
                    <input type="text" id="kodeBarang" name="kodeBarang" placeholder="Contoh: BRG-ELK-005" required>
                </div>

                <div class="field">
                    <label for="namaBarang">Nama Barang</label>
                    <input type="text" id="namaBarang" name="namaBarang" placeholder="Nama barang" required>
                </div>

                <div class="dua-kolom">
                    <div class="field">
                        <label for="kategoriBarang">Kategori</label>
                        <select id="kategoriBarang" name="kategoriBarang" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Perkakas">Perkakas</option>
                            <option value="Material">Material</option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="satuanUnit">Satuan</label>
                        <select id="satuanUnit" name="satuanUnit" required>
                            <option value="">Pilih Satuan</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Box">Box</option>
                            <option value="Unit">Unit</option>
                            <option value="Pallet">Pallet</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-simpan">Simpan Barang</button>
            </form>
        </div>
    </section>

</body>
</html>