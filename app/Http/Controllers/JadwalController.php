<?php
namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('jadwal.index', compact('jadwal'));
    }

    public function indexa()
    {
        $jadwal = Jadwal::all();
        return view('jadwala.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function indexAdmin()
    {
        $jadwal = Jadwal::all();
        return view('admin.jadwal.index', compact('jadwal'));
    }


    public function create()
    {
        $karyawans = Karyawan::all();
        return view('jadwal.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'karyawan_id' => 'required|exists:karyawans,id',
        'nama' => 'required',
        'tanggal' => 'required',
        'jam_masuk' => 'required',
        'jam_piket' => 'required',
        'jam_pulang' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $jadwal = new Jadwal;
    $jadwal->karyawan_id = $request->karyawan_id;
    $jadwal->nama = $request->nama;
    $jadwal->tanggal = $request->tanggal;
    $jadwal->jam_masuk = $request->jam_masuk;
    $jadwal->jam_piket = $request->jam_piket;
    $jadwal->jam_pulang = $request->jam_pulang;

    if ($request->hasFile('gambar')) {
        $fileName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images'), $fileName);
        $jadwal->gambar = $fileName;
    }

    $jadwal->save();

    return redirect()->route('jadwal.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'nama' => 'required',
            'tanggal' => 'required',
            'jam_masuk' => 'required',
            'jam_piket' => 'required',
            'jam_pulang' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->karyawan_id = $request->karyawan_id;
        $jadwal->nama = $request->nama;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->jam_masuk = $request->jam_masuk;
        $jadwal->jam_piket = $request->jam_piket;
        $jadwal->jam_pulang = $request->jam_pulang;
        $jadwal->save();

        return redirect()->route('jadwal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
    
        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil dihapus');
    }


    public function downloadPDF()
    {
        $jadwals = Jadwal::all(); // Ambil semua data absensi dari database

        // Load view yang akan digunakan untuk membuat PDF
        $pdf = PDF::loadView('jadwala.pdf', compact('jadwals'));

        // Menggunakan nama file yang unik untuk PDF
        $pdfFileName = 'laporan_absensi_' . time() . '.pdf';

        // Mengembalikan file PDF untuk diunduh
        return $pdf->download($pdfFileName);
    }
}
