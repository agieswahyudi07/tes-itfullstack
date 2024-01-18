<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SiswaModel;
use App\Exports\SiswaExport;
use App\Models\LembagaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = SiswaModel::orderBy('id', 'desc')->get();
        $title = "Siswa";
        $data = [
            'siswa' => $siswa,
            'title' => $title,
        ];

        return view('siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lembaga = LembagaModel::all();
        // dd($lembaga);
        $title = "Siswa";

        $data = [
            'lembaga' => $lembaga,
            'title' => $title
        ];

        return view('siswa.add', compact('data'));
    }


    public function store(Request $request)
    {
        $lembaga = DB::table('lembaga')->where('lembaga_id', '=', $request->selLembaga)->first();
        if ($lembaga) {
            Session::flash('txtLembaga', $lembaga->nama_lembaga);
        }

        Session::flash('txtSiswaNis', $request->txtSiswaNis);
        Session::flash('txtSiswaName', $request->txtSiswaName);
        Session::flash('txtSiswaEmail', $request->txtSiswaEmail);

        // $file = $request->file('txtSiswaFoto');
        // Session::put('txtSiswaFoto', [
        //     'name' => $file->getClientOriginalName(),
        //     'extension' => $file->getClientOriginalExtension(),
        //     'size' => $file->getSize(),
        // ]);

        $request->validate([
            'txtSiswaNis' => 'required',
            'txtSiswaName' => 'required',
            'txtSiswaEmail' => 'required|email',
            'selLembaga' => 'integer|required',
            'txtSiswaFoto' => 'required|mimes:jpg,jpeg,png|max:100',
        ], [
            'txtSiswaNis.required' => 'Nis diperlukan.',
            'txtSiswaName.required' => 'Nama Siswa diperlukan.',
            'txtSiswaEmail.required' => 'Email Siswa diperlukan.',
            'txtSiswaEmail.email' => 'Format email tidak valid.',
            'selLembaga.integer' => 'Pilih Lembaga Siswa.',
            'selLembaga.required' => 'Pilih Lembaga Siswa.',
            'txtSiswaFoto.required' => 'Wajib Isi Foto Siswa',
            'txtSiswaFoto.mimes' => 'Format file yang diizinkan: jpg, jpeg, png.',
            'txtSiswaFoto.max' => 'Ukuran file maksimal: 100 KB.',
        ]);


        $nis = $request->input('txtSiswaNis');
        $nama_siswa = $request->input('txtSiswaName');
        $email = $request->input('txtSiswaEmail');
        $lembaga_id = intval($request->input('selLembaga'));

        $photo = $request->file('txtSiswaFoto');
        $filename = now()->format('d-M-y') . '_' . $photo->getClientOriginalName();
        $path = 'foto-siswa/' . $filename;
        Storage::disk('public')->put($path, file_get_contents($photo));

        $data = [
            'nis' => $nis,
            'nama_siswa' => $nama_siswa,
            'email' => $email,
            'foto_path' => $filename,
            'lembaga_id' => $lembaga_id,
        ];

        $insert = SiswaModel::create($data);

        if ($insert) {
            Session::flash('success', 'Data successfully Inserted.');
            return redirect()->route('admin.index');
        } else {
            Session::flash('success', 'Data Insert failed.');
            return redirect()->route('admin.index');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = SiswaModel::find($id);

        if (!$siswa) {
            return redirect()->route('admin.index')->with('error', 'Siswa not found');
        }

        $lembaga = LembagaModel::all();
        $title = "Edit Siswa";

        $data = [
            'siswa' => $siswa,
            'lembaga' => $lembaga,
            'title' => $title
        ];

        return view('siswa.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lembaga = DB::table('lembaga')->where('id', '=', $request->selLembaga)->first();
        if ($lembaga) {
            Session::flash('txtLembaga', $lembaga->nama_lembaga);
        }

        Session::flash('txtSiswaNis', $request->txtSiswaNis);
        Session::flash('txtSiswaName', $request->txtSiswaName);
        Session::flash('txtSiswaEmail', $request->txtSiswaEmail);

        $request->validate([
            'txtSiswaNis' => 'required',
            'txtSiswaName' => 'required',
            'txtSiswaEmail' => 'required|email',
            'selLembaga' => 'integer|required',
            'txtSiswaFoto' => 'mimes:jpg,jpeg,png|max:100',
        ], [
            'txtSiswaNis.required' => 'Nis diperlukan.',
            'txtSiswaName.required' => 'Nama Siswa diperlukan.',
            'txtSiswaEmail.required' => 'Email Siswa diperlukan.',
            'txtSiswaEmail.email' => 'Format email tidak valid.',
            'selLembaga.integer' => 'Pilih Lembaga Siswa.',
            'selLembaga.required' => 'Pilih Lembaga Siswa.',
            'txtSiswaFoto.mimes' => 'Format file yang diizinkan: jpg, jpeg, png.',
            'txtSiswaFoto.max' => 'Ukuran file maksimal: 100 KB.',
        ]);

        $siswa = SiswaModel::find($id);

        if (!$siswa) {
            return redirect()->route('admin.index')->with('error', 'Siswa not found');
        }

        $nis = $request->input('txtSiswaNis');
        $nama_siswa = $request->input('txtSiswaName');
        $email = $request->input('txtSiswaEmail');
        $lembaga_id = intval($request->input('selLembaga'));

        $photo = $request->file('txtSiswaFoto');

        // Jika pengguna mengunggah foto baru
        if ($photo) {
            $filename = now()->format('d-M-y') . '_' . $photo->getClientOriginalName();
            $path = 'foto-siswa/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($photo));
            $siswa->foto_path = $filename;
        } elseif ($request->has('txtSiswaFotoPath')) {
            // Jika tidak ada foto baru diunggah, gunakan path dari database
            $siswa->foto_path = $request->input('txtSiswaFotoPath');
        }

        $data = [
            'nis' => $nis,
            'nama_siswa' => $nama_siswa,
            'email' => $email,
            'lembaga_id' => $lembaga_id,
        ];

        $update = $siswa->update($data);

        if ($update) {
            Session::flash('success', 'Data successfully updated.');
            return redirect()->route('admin.index');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SiswaModel::find($id)->delete();
        Session::flash('success', 'Data successfully deleted.');
        return redirect()->route('admin.index');
    }

    public function export()
    {
        $columns = [
            'siswa.*',
            'lembaga.nama_lembaga',
        ];

        $data = SiswaModel::select($columns)
            ->join('lembaga', 'lembaga.lembaga_id', '=', 'siswa.lembaga_id')
            ->get();

        return Excel::download(new SiswaExport($data), 'Siswa |' . Carbon::now()->timestamp . '.xlsx');
    }
}
