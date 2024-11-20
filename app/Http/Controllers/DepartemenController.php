<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartemenController extends Controller
{
    public function index(Request $request)
    {
        $query = Departemen::query();
        $query->select('departemen.kode_dept', 'departemen.nama_dept');
        if (!empty($request->nama_dept)) {
            // $query->where('departemen.kode_dept', 'like', '%' . $request->kode_dept . '%');
            $query->where('departemen.nama_dept', 'like', '%' . $request->nama_dept . '%');
        }
        $departemen = $query->paginate(12);
        return view('departemen.index', compact('departemen'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(
                [
                    'kode_dept' => 'required|max:3|min:2',
                    'nama_dept' => 'required|string|max:50',

                ],
                [
                    'kode_dept.required' => 'Kode Departemen wajib diisi.',
                    'kode_dept.max' => 'Kode Departemen maksimal 3 karakter.',
                    'kode_dept.min' => 'Kode Departemen minimal 3 karakter.',
                    'nama_dept.required' => 'Nama Departemen wajib diisi.',
                    'nama_dept.max' => 'Nama Departemen maksimal 50 karakter.',
                ]
            );
            $data = [
                'kode_dept' => $request->kode_dept,
                'nama_dept' => $request->nama_dept
            ];
            DB::table('departemen')->insert($data);
            return redirect()->route('departemen.index')->with('success', 'Data departemen berhasil disimpan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap error validation dan masukkan ke sesi
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data gagal disimpan: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $kode = $request->kode; // ambil dari ajax
        $departemen = DB::table('departemen')->where('kode_dept', $kode)->first();
        return view('departemen.edit', compact('departemen'));
    }

    public function update($kode, Request $request)
    {
        try {
            $validatedData = $request->validate(
                [
                    'kode_dept' => 'required|max:3|min:2',
                    'nama_dept' => 'required|string|max:50',

                ],
                [
                    'kode_dept.required' => 'Kode Departemen wajib diisi.',
                    'kode_dept.max' => 'Kode Departemen maksimal 3 karakter.',
                    'kode_dept.min' => 'Kode Departemen minimal 3 karakter.',
                    'nama_dept.required' => 'Nama Departemen wajib diisi.',
                    'nama_dept.max' => 'Nama Departemen maksimal 50 karakter.',
                ]
            );

            $data = [
                'kode_dept' => $request->kode_dept,
                'nama_dept' => $request->nama_dept
            ];
            DB::table('departemen')->where('kode_dept', $kode)->update($data);
            return redirect()->route('departemen.index')->with('success', 'Data departemen berhasil diupdate');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap error validation dan masukkan ke sesi
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data gagal diupdate: ' . $e->getMessage());
        }
    }

    public function destroy($kode)
    {
        try {
            DB::table('departemen')->where('kode_dept', $kode)->delete();
            return redirect()->route('departemen.index')->with('success', 'Data departemen berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data gagal dihapus: ' . $e->getMessage());
        }
    }
}
