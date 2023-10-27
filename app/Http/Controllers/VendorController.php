<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
   

    public function index()
    {
        $vendors = DB::table('vendor')
            ->join('badan_hukum_vendor', 'vendor.id_badan_hukum', '=', 'badan_hukum_vendor.id_badan_hukum')
            ->select('vendor.*', 'badan_hukum_vendor.nama_hukum')
            ->get();
    
        return view('vendor.data-vendor', compact('vendors'));
    }
    
    
        public function create()
        {
            $badan_hukum = DB::table('badan_hukum_vendor')->get();

            return view('vendor.create-vendor', compact('badan_hukum'));
        }
    
        public function store(Request $request)
        {
            DB::table('vendor')->insert([
                'nama_vendor' => $request->input('nama_vendor'),
                'id_badan_hukum' => $request->input('badan_hukum'),
                'status_vendor' => $request->input('status'),
            ]);
    
            return redirect()->route('data-vendor')->with('success', 'Data vendor berhasil disimpan');
        }
    
        public function edit($id_vendor)
        {
            $vendor = DB::table('vendor')->where('id_vendor', $id_vendor)->first();
            return view('vendor.edit-vendor', compact('vendor'));
        }
    
        public function update(Request $request, $id_vendor)
        {
            DB::table('vendor')
                ->where('id_vendor', $id_vendor)
                ->update([
                    'nama_vendor' => $request->input('nama_vendor'),
                    'badan_hukum' => $request->input('badan_hukum'),
                    'status_vendor' => $request->input('status'),
                ]);
    
            return redirect()->route('data-vendor')->with('success', 'Data vendor berhasil diperbarui');
        }
    

        public function destroy($id_vendor)
        {
            DB::table('vendor')->where('id_vendor', $id_vendor)->update(['deleted_at' => now()]);
        
            return redirect()->route('data-vendor')->with('success', 'Data vendor berhasil dihapus secara permanen');
        }
    


        public function deleted()
        {
            $trashes = DB::table('vendor')
            ->join('badan_hukum_vendor', 'vendor.id_badan_hukum', '=', 'badan_hukum_vendor.id_badan_hukum')
            ->select('vendor.*', 'badan_hukum_vendor.nama_hukum')
            ->whereNotNull('vendor.deleted_at')
            ->get();
    
        return view('vendor.deleted-vendor', compact('trashes'));
        }
        

    
        public function restore($id_vendor)
        {
            DB::table('vendor')
                ->where('id_vendor', $id_vendor)
                ->update(['deleted_at' => null]);
    
            return redirect()->route('data-vendor')->with('success', 'Data vendor berhasil dikembalikan');
        }
    }
    

?>  