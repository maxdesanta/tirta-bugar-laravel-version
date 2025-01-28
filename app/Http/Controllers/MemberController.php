<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

// import model
use App\Models\ViewMemberList;
use App\Models\ViewDetailMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller\Middleware;

class MemberController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $filter = $request->input('combined_filter');
        $sortDate = $request->input('sort_by_date');

        $admin = Auth::guard('admin')->user();
        $members = ViewMemberList::query();

        if($search) {
            $members->where('nama_member', 'ILIKE', '%'.$search.'%');
        }

        if($filter === 'aktif') {
            $members->where('selisih','>', 0);
        } else if($filter === 'tidak_aktif') {
            $members->where('selisih', 0);
        } else if($filter === 'hampir_habis') {
            $members->where('selisih', '<', 7)->where('selisih', '>', 0);
        }else if($filter === 'all-asc') {
            $members->orderBy('nama_member', 'ASC');
        } else if($filter === 'all-desc') {
            $members->orderBy('nama_member', 'DESC');
        }

        if($sortDate) {
            $members->orderBy('tanggal_berakhir', $sortDate);  
        }

        $members = $members->paginate(5);
        $members->appends($request->all());

        $jmlhMember = ViewMemberList::all()->count();
        $jmlhNonAktif = ViewMemberList::where('selisih', 0)->count();
        $jmlhMemberAktif = ViewMemberList::where('selisih', '>', 0)->count();
        

        return view('admin.index', compact('members', 'jmlhMember', 'jmlhNonAktif','jmlhMemberAktif', 'search', 'admin'));
    }

    public function getNotification() {
        // Ambil data member yang masa berlakunya habis
        $nonActiveMembers = ViewMemberList::where('selisih', 0)
            ->orderBy('tanggal_berakhir', 'ASC')
            ->limit(5)
            ->get(['nama_member', 'format_tanggal_berakhir']);

        // Strukturkan data notifikasi
        $notificationsData = [
            'hasNotifications' => $nonActiveMembers->isNotEmpty(),
            'count' => $nonActiveMembers->count(),
            'messages' => $nonActiveMembers->map(function ($member) {
                return "{$member->nama_member} masa berlakunya sudah habis pada {$member->format_tanggal_berakhir}";
            })
        ];

        return response()->json($notificationsData);
    }

    public function showDetail($id){
        $detailMember = ViewDetailMember::where('id_member', $id)->first();
        $admin = Auth::guard('admin')->user();
        return view('admin.detail-member', compact('detailMember', 'admin'));
    }

    public function add(){
        $admin = Auth::guard('admin')->user();
        return view('admin.add-member', compact('admin'));
    }

    public function create(Request $request){
        $validated = $request->validate([
            'nama' => 'required|max:150',
            'email' => 'required',
            'nomor-telepon' => 'required|numeric',
            'durasi' => 'required|integer',
            'tanggal-awal' => 'required|date',
            'tanggal-akhir' => 'required|date',
        ]);

        $randomPw = Str::random(8);
        $password = base64_encode($randomPw);
        $admin = Auth::guard('admin')->user();

        try {
            DB::statement('CALL tambah_member(?,?,?,?,?,?,?,?)', [
                $validated['nama'],
                $validated['email'],
                $password,
                $validated['nomor-telepon'],
                $validated['tanggal-awal'],
                $validated['tanggal-akhir'],
                $validated['durasi'],
                $admin->id_admin
            ]);

            return redirect('/admin')->with('success', 'Member berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function update($id){
        $admin = Auth::guard('admin')->user();
        $detailMember = Member::where('id_member', $id)->first();
        return view('admin.edit-member', compact('detailMember', 'admin'));
    }

    public function edit(Request $request){
        $validated = $request->validate([
            'id' => 'required|integer|exists:member,id_member',
            'nama' => 'required|max:150',
            'email' => 'required',
            'nomor-telepon' => 'required|numeric',
            'durasi' => 'required|integer',
            'tanggal-awal' => 'required|date',
            'tanggal-akhir' => 'required|date',
        ]);

        $admin = Auth::guard('admin')->user();

        try {
            // Cara 1: Menggunakan DB::statement
            DB::statement('CALL edit_member(?,?,?,?,?,?,?,?)', [
                $validated['id'],
                $validated['nama'],
                $validated['email'],
                $validated['nomor-telepon'],
                $validated['tanggal-awal'],
                $validated['tanggal-akhir'],
                $admin->id_admin,
                $validated['durasi'],
            ]);

            return redirect('/admin/member/' . $validated['id'])->with('success', 'Member berhasil diubah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id){
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect('/admin')->with('success', 'Member berhasil dihapus.');
    }
}
