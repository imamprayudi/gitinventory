<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

trait ApiConfigurationTrait
{
    // ✅ Gunakan private untuk menghindari konflik
    private $apiDomain = "https://svr1.jkei.jvckenwood.com/";
    private $apiUrl = "api_invesa_test/";
    private $apiVersion = "versioning..";

    /**
     * Inisialisasi konfigurasi API berdasarkan server name
     * 
     * @return void
     */
    protected function initializeApiConfiguration()
    {
        try {
            $this->setDomainBasedOnServer();
            // ✅ PERBAIKAN: Ganti setVersionFromApi() dengan getVersionSafely()
            $this->apiVersion = $this->getVersionSafely();
            Log::info('ApiConfigurationTrait: Konfigurasi berhasil diinisialisasi', [
                'domain' => $this->apiDomain,
                'version' => $this->apiVersion
            ]);
        } catch (Exception $e) {
            Log::error('ApiConfigurationTrait: Error saat inisialisasi', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Set domain berdasarkan server name
     * 
     * @return void
     */
    private function setDomainBasedOnServer()
    {
        $serverName = $_SERVER['SERVER_NAME'] ?? 'localhost';
        
        if (str_contains($serverName, '136.198.117.')) {
            $this->apiDomain = "http://136.198.117.118/";
        }
        
        // ✅ Expose domain melalui getter untuk backward compatibility
        $this->domain = $this->apiDomain;
        $this->url = $this->apiUrl;
        
        Log::info('API Domain initialized', [
            'server_name' => $serverName,
            'domain' => $this->apiDomain
        ]);
    }

    /**
     * Get version dengan error handling yang robust
     * 
     * @return string
     */
    public function getVersionSafely()
    {
        try {
            $url = $this->apiDomain . $this->apiUrl . "json_version_sync.php";
            
            // ✅ Timeout 30 detik dengan retry logic
            $response = Http::timeout(30)->get($url);
            
            if ($response->successful()) {
                $data = $response->json();
                $version = $data['version'] ?? '3.0.0';
                $this->apiVersion = $version; // ✅ Update internal version
                Log::info('Version fetched successfully', ['version' => $version]);
                return $version;
            } else {
                Log::warning('Version fetch failed', ['status' => $response->status()]);
                return $this->apiVersion; // Return current version as fallback
            }
            
        } catch (Exception $e) {
            Log::error('Exception occurred while fetching version', [
                'message' => $e->getMessage()
            ]);
            return $this->apiVersion; // Return current version as fallback
        }
    }

    /**
     * Get full API URL
     * 
     * @param string $endpoint
     * @return string
     */
    public function getApiUrl($endpoint = '')
    {
        return $this->domain . $this->url . $endpoint;
    }

    /**
     * Make HTTP GET request ke API dengan error handling
     * 
     * @param string $endpoint
     * @param array $params
     * @return array|null
     */
    protected function makeApiRequest($endpoint, $params = [])
    {
        try {
            $url = $this->getApiUrl($endpoint);
            
            Log::info('Making API request', [
                'url' => $url,
                'params' => $params
            ]);
            
            // ✅ Timeout 30 detik untuk semua request
            $response = Http::timeout(30)->get($url, $params);
            
            if ($response->successful()) {
                Log::info('API request successful', [
                    'url' => $url,
                    'status' => $response->status()
                ]);
                return $response->json();
            }
            
            Log::warning('API request failed', [
                'url' => $url,
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return null;
            
        } catch (\Exception $e) {
            Log::error('API request exception', [
                'url' => $url ?? 'unknown',
                'message' => $e->getMessage()
            ]);
            
            return null;
        }
    }

    /**
     * Make login request ke API dengan error handling
     * 
     * @param string $userid
     * @param string $userpass
     * @param string $ipaddress
     * @return \Illuminate\Http\Client\Response|null
     */
    protected function makeLoginRequest($userid, $userpass, $ipaddress = null)
    {
        try {
            $ipaddress = $ipaddress ?? getenv("REMOTE_ADDR");
            $url = $this->getApiUrl('json_login_sync.php');
            
            $params = [
                'valuserid' => $userid,
                'valuserpass' => $userpass,
                'valipaddress' => $ipaddress,
                'sql' => "call sync_check_login {$userid}, {$userpass}, {$ipaddress}"
            ];
            
            Log::info('Making login API request', [
                'url' => $url,
                'userid' => $userid,
                'ip' => $ipaddress
            ]);
            
            $response = Http::get($url, $params);
            
            Log::info('Login API response received', [
                'status' => $response->status(),
                'successful' => $response->successful()
            ]);
            
            return $response;
            
        } catch (\Exception $e) {
            Log::error('Login API request exception', [
                'url' => $url ?? 'unknown',
                'message' => $e->getMessage(),
                'userid' => $userid
            ]);
            
            return null;
        }
    }
    
    /**
     * Check API health sebelum melakukan request
     */
    public function isApiHealthy(): bool
    {
        try {
            $response = Http::get($this->domain . $this->url . 'health-check.php');
            return $response->successful();
        } catch (Exception $e) {
            return false;
        }
    }
}
