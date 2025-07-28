<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Traits\ApiConfigurationTrait;

class LoginController extends Controller
{
    use ApiConfigurationTrait;
    
    /**
     * Constructor - inisialisasi konfigurasi API
     */
    public function __construct()
    {
        $this->initializeApiConfiguration();
    }

    /**
     * Tampilkan halaman login
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Menghapus session
        $request->session()->forget('session_gitinventory_id');
        $request->session()->forget('session_gitinventory_userid');
        $request->session()->forget('session_gitinventory_username');

        return view('login');
    }

    /**
     * Proses login user
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postlogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'userid' => 'required|string',
            'password' => 'required|string'
        ]);
        
        $userid = $request->userid;
        $userpass = $request->password;
        
        // Menggunakan method dari trait untuk login API
        $response = $this->makeLoginRequest($userid, $userpass);
        
        if (!$response) {
            return redirect('/login')->with('status', 'Terjadi kesalahan koneksi ke server.');
        }
        
        // Cek response message
        $obj = json_decode($response->body());
        
        if (!$obj || $obj->message == 'Failure') {
            return redirect('/login')->with('status', 'Kombinasi email dan password salah.');
        }

        // Buat session
        $request->session()->put('session_gitinventory_id', $obj->id);
        $request->session()->put('session_gitinventory_userid', $obj->login);
        $request->session()->put('session_gitinventory_username', $obj->name);

        return redirect('/home');
    }
}
