<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $cacertPath = 'C:/wamp64/bin/php/php8.2.18/extras/ssl/cacert.pem';

    public function get($url)
    {
        $response = Http::withOptions(['verify' => $this->cacertPath])->get($url);

        if ($response->successful()) {
            return [
                'status' => $response->status(),
                'result' => $response->json(),
            ];
        } else {
            return [
                'status'  => $response->status(),
                'message' => 'Failed to retrieve data.',
            ];
        }

        return ['status' => 500, 'message' => 'Something went wrong'];
    }
}
