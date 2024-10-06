<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper;

class Bahan_BakuController extends Controller
{
    protected $domain = "https://svr1.jkei.jvckenwood.com/";
    protected $url = "api_invesa_test/";
    protected $gudang = 'Gudang Umum';
    protected $kategori = 'Bahan Baku';
    protected $version = '1.0.0';


    public function __construct()
    {
        $serverName = $_SERVER['SERVER_NAME'] ?? null;
        if (str_contains($serverName, '136.198.117.') || str_contains($serverName, 'localhost')) {
            $this->domain = "http://136.198.117.118/";
        }

        $getVersion = Http::get($this->domain . $this->url . "json_version_sync.php");
        $this->version = $getVersion['version'];
    }
    public function gudang_material(Request $request)
    {
        $this->gudang = 'Gudang Material';
        $gitversions =$this->version;
        return view('admins.bahan_baku_gm', compact('gitversions'));
    }
    public function gudang_umum(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('admins.bahan_baku_gu', compact('gitversions'));
    }
    
}
