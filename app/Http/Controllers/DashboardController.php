<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http; // ✅ TAMBAHKAN INI
use App\Http\Traits\ApiConfigurationTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use ApiConfigurationTrait;
    
    // ✅ HAPUS property $domain yang konflik
    // protected $domain; // HAPUS INI
    
    /**
     * Constructor dengan error handling yang robust
     */
    public function __construct()
    {
        try {
            $this->initializeApiConfiguration();
            Log::info('DashboardController: Berhasil diinisialisasi');
        } catch (Exception $e) {
            Log::error('DashboardController: Error di constructor', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            // Jangan throw exception di constructor untuk menghindari fatal error
        }
    }
    
    /**
     * Initialize domain dengan debugging
     */
    // private function initializeDomain()
    // {
    //     try {
    //         Log::info('DashboardController: Memulai inisialisasi domain');
            
    //         $serverName = $_SERVER['SERVER_NAME'] ?? 'localhost';
            
    //         Log::info('DashboardController: Checking server name', ['server_name' => $serverName]);
            
    //         // str_contains($serverName, 'localhost') || 
    //         if (str_contains($serverName, '136.198.117.')) {
    //             $this->domain = "http://136.198.117.118/";
    //             Log::info('DashboardController: Domain set to local/test', ['domain' => $this->domain]);
    //         } else {
    //             $this->domain = "https://svr1.jkei.jvckenwood.com/";
    //             Log::info('DashboardController: Domain set to production', ['domain' => $this->domain]);
    //         }
            
    //     } catch (Exception $e) {
    //         Log::error('DashboardController: Error saat inisialisasi domain', [
    //             'error' => $e->getMessage()
    //         ]);
    //         // Fallback ke domain default
    //         $this->domain = "http://136.198.117.118/";
    //     }
    // }
    
    /**
     * Get version dengan debugging dan error handling
     */
    private function getVersionSafely()
    {
        try {
            Log::info('DashboardController: Memulai pengambilan version');
            
            $url = $this->domain . $this->url . "json_version_sync.php";
            Log::info('DashboardController: URL version', ['url' => $url]);
            
            // ✅ Gunakan timeout yang lebih reasonable
            $startTime = microtime(true);
            $response = Http::get($url); // Ubah dari 500 ke 10 detik
            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000;
            
            if ($response->successful()) {
                $data = $response->json();
                $version = $data['version'] ?? 'Version not available';
                Log::info('DashboardController: Version berhasil diambil', ['version' => $version]);
                return $version;
            } else {
                Log::warning('DashboardController: Response tidak successful', [
                    'status' => $response->status()
                ]);
                return 'Version not available (HTTP ' . $response->status() . ')';
            }
            
        } catch (Exception $e) {
            Log::error('DashboardController: Error saat mengambil version', [
                'error' => $e->getMessage(),
                'url' => $url ?? 'unknown'
            ]);
            return 'Version error: Connection failed';
        }
    }
    
    /**
     * Get information dengan debugging lengkap
     */
    private function getInformationSafely()
    {
        try {
            Log::info('DashboardController: Memulai pengambilan information');
            
            $url = $this->domain . $this->url . "json_information.php";
            Log::info('DashboardController: URL information', ['url' => $url]);
            
            $startTime = microtime(true);
            $response = Http::get($url);
            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000;
            
            Log::info('DashboardController: Response information diterima', [
                'status' => $response->status(),
                'duration_ms' => round($duration, 2),
                'response_size' => strlen($response->body())
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                Log::info('DashboardController: Information data structure', [
                    'keys' => array_keys($data),
                    'lastsyncinvesaweb_count' => count($data['lastsyncinvesaweb'] ?? []),
                    'sql_bar_twomonth_count' => count($data['sql_bar_twomonth'] ?? [])
                ]);
                
                return $data;
            } else {
                Log::warning('DashboardController: Information response tidak successful', [
                    'status' => $response->status(),
                    'body' => substr($response->body(), 0, 500) // Limit log size
                ]);
                return $this->getDefaultInformation();
            }
            
        } catch (Exception $e) {
            Log::error('DashboardController: Error saat mengambil information', [
                'error' => $e->getMessage(),
                'url' => $url ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);
            return $this->getDefaultInformation();
        }
    }
    
    /**
     * Get default information dengan logging
     */
    private function getDefaultInformation()
    {
        Log::info('DashboardController: Menggunakan default information');
        
        return [
            'lastsyncinvesaweb' => [['sync_date' => 'Not available']],
            'sql_bar_twomonth' => [],
            'sql_docin_twomonth' => [],
            'sql_docout_twomonth' => [],
            'sql_bar_onemonth' => [],
            'sql_docin_onemonth' => [],
            'sql_docout_onemonth' => [],
            'sql_bar_currmonth' => [],
            'sql_docin_currmonth' => [],
            'sql_docout_currmonth' => []
        ];
    }
    
    /**
     * Test database connection
     */
    private function testDatabaseConnection()
    {
        try {
            Log::info('DashboardController: Testing database connection');
            
            $startTime = microtime(true);
            DB::connection()->getPdo();
            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000;
            
            Log::info('DashboardController: Database connection successful', [
                'duration_ms' => round($duration, 2)
            ]);
            
            return true;
        } catch (Exception $e) {
            Log::error('DashboardController: Database connection failed', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
    
    /**
     * Debug memory usage
     */
    private function logMemoryUsage($stage)
    {
        $memoryUsage = memory_get_usage(true);
        $memoryPeak = memory_get_peak_usage(true);
        
        Log::info("DashboardController: Memory usage at {$stage}", [
            'current_mb' => round($memoryUsage / 1024 / 1024, 2),
            'peak_mb' => round($memoryPeak / 1024 / 1024, 2)
        ]);
    }

    /**
     * Prepare safe data untuk view dengan default values
     */
    private function prepareSafeViewData($get_info)
    {
        try {
            // Default structure untuk setiap array data
            $defaultDataStructure = [
                'totaldokinvesa' => 0,
                'input23bc' => 0, 'percent23bc' => 0,
                'input27bc' => 0, 'percent27bc' => 0,
                'input40bc' => 0, 'percent40bc' => 0,
                'input262bc' => 0, 'percent262bc' => 0,
                'output25bc' => 0, 'percent25bc' => 0,
                'output27bc' => 0, 'percent27bc' => 0,
                'output30bc' => 0, 'percent30bc' => 0,
                'output41bc' => 0, 'percent41bc' => 0,
                'output261bc' => 0, 'percent261bc' => 0
            ];
            
            // Prepare data dengan fallback ke default
            $lastsyncinvesaweb = $get_info['lastsyncinvesaweb'][0]['sync_date'] ?? 'Data tidak tersedia';
            
            // Ensure arrays have at least one element with default structure
            $sql_bar_onemonth = !empty($get_info['sql_bar_onemonth']) ? $get_info['sql_bar_onemonth'] : [$defaultDataStructure];
            $sql_bar_currmonth = !empty($get_info['sql_bar_currmonth']) ? $get_info['sql_bar_currmonth'] : [$defaultDataStructure];
            $sql_docin_currmonth = !empty($get_info['sql_docin_currmonth']) ? $get_info['sql_docin_currmonth'] : [$defaultDataStructure];
            $sql_docout_currmonth = !empty($get_info['sql_docout_currmonth']) ? $get_info['sql_docout_currmonth'] : [$defaultDataStructure];
            
            // Ensure first element exists and has required keys
            foreach (['sql_bar_onemonth', 'sql_bar_currmonth', 'sql_docin_currmonth', 'sql_docout_currmonth'] as $arrayName) {
                $arrayData = $$arrayName;
                if (empty($arrayData[0])) {
                    $arrayData[0] = $defaultDataStructure;
                } else {
                    // Merge dengan default untuk memastikan semua key ada
                    $arrayData[0] = array_merge($defaultDataStructure, $arrayData[0]);
                }
                $$arrayName = $arrayData;
            }
            
            Log::info('DashboardController: Data berhasil dipreparasi dengan aman', [
                'lastsyncinvesaweb' => $lastsyncinvesaweb,
                'data_counts' => [
                    'sql_bar_onemonth' => count($sql_bar_onemonth),
                    'sql_bar_currmonth' => count($sql_bar_currmonth),
                    'sql_docin_currmonth' => count($sql_docin_currmonth),
                    'sql_docout_currmonth' => count($sql_docout_currmonth)
                ]
            ]);
            
            return compact('lastsyncinvesaweb', 'sql_bar_onemonth', 'sql_bar_currmonth', 'sql_docin_currmonth', 'sql_docout_currmonth');
            
        } catch (Exception $e) {
            Log::error('DashboardController: Error saat mempreparasi data', [
                'error' => $e->getMessage()
            ]);
            
            // Return completely safe default data
            return [
                'lastsyncinvesaweb' => 'Error memuat data',
                'sql_bar_onemonth' => [$defaultDataStructure],
                'sql_bar_currmonth' => [$defaultDataStructure],
                'sql_docin_currmonth' => [$defaultDataStructure],
                'sql_docout_currmonth' => [$defaultDataStructure]
            ];
        }
    }

    // Update method index untuk menggunakan prepareSafeViewData
    public function index(Request $request)
    {
        try {
            Log::info('DashboardController: Index method dimulai');
            
            // Get version dan information
            $gitversions = $this->getVersionSafely();
            $get_info = $this->getInformationSafely();
            
            // Prepare safe data
            $safeData = $this->prepareSafeViewData($get_info);
            
            // Prepare view data
            $viewData = array_merge(['gitversions' => $gitversions], $safeData);
            
            Log::info('DashboardController: Siap render view dengan data aman');
            
            return view('dashboard', $viewData);
            
        } catch (Exception $e) {
            Log::error('DashboardController: Fatal error di index method', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            // Return error view
            return response()->view('errors.500', [
                'error' => config('app.debug') ? $e->getMessage() : 'Terjadi kesalahan server'
            ], 500);
        }
    }

    /**
     * Legacy index method dengan debugging
     */
    public function index_old(Request $request)
    {
        try {
            Log::info('DashboardController: Index_old method dimulai');
            
            // Clear sessions dengan logging
            $sessionKeys = ['session_gitinventory_id', 'session_gitinventory_userid', 'session_gitinventory_username'];
            foreach ($sessionKeys as $key) {
                if ($request->session()->has($key)) {
                    $request->session()->forget($key);
                    Log::info("DashboardController: Session key '{$key}' dihapus");
                }
            }
            
            // Get version
            $gitversions = $this->getVersionSafely();
            
            Log::info('DashboardController: Index_old method selesai', [
                'gitversions' => $gitversions
            ]);
            
            return view('dashboard', compact('gitversions'));
            
        } catch (Exception $e) {
            Log::error('DashboardController: Error di index_old method', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->view('errors.500', [
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Debug method untuk testing
     */
    public function debug(Request $request)
    {
        try {
            Log::info('DashboardController: Debug method dipanggil');
            
            $debugInfo = [
                'php_version' => PHP_VERSION,
                'laravel_version' => app()->version(),
                'server_info' => [
                    'SERVER_NAME' => $_SERVER['SERVER_NAME'] ?? 'unknown',
                    'HTTP_HOST' => $_SERVER['HTTP_HOST'] ?? 'unknown',
                    'REQUEST_URI' => $_SERVER['REQUEST_URI'] ?? 'unknown'
                ],
                'domain' => $this->domain,
                'url' => $this->url,
                'memory_usage' => [
                    'current_mb' => round(memory_get_usage(true) / 1024 / 1024, 2),
                    'peak_mb' => round(memory_get_peak_usage(true) / 1024 / 1024, 2)
                ],
                'database_connected' => $this->testDatabaseConnection(),
                'version_test' => $this->getVersionSafely()
            ];
            
            Log::info('DashboardController: Debug info', $debugInfo);
            
            return response()->json($debugInfo);
            
        } catch (Exception $e) {
            Log::error('DashboardController: Error di debug method', [
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Check API health
     */
    private function isApiHealthy()
    {
        try {
            $response = Http::get($this->domain . $this->url . 'health.php');
            return $response->successful();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Monitor API performance
     */
    private function monitorApiPerformance($startTime, $endpoint)
    {
        $duration = microtime(true) - $startTime;
        
        if ($duration > 5) { // Jika lebih dari 5 detik
            Log::warning("API call lambat: {$endpoint}", [
                'duration' => $duration,
                'endpoint' => $endpoint
            ]);
        }
    }
}
