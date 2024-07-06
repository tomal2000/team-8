<?php
namespace App\Classes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SmsMessage {

    protected string $baseUrl;
    protected string $apiKey;
    protected string $clintId;
    protected string $senderId;
    protected string $to;
    protected array $lines;
    protected string $dryRun = 'no';

    public function __construct($lines = [])
    {
         $this->lines = $lines;

         // Pull in config from the config/services.php file.
        $this->apiKey = config('sms.smsq.api_key');
        $this->clintId = config('sms.smsq.clint_id');
        $this->senderId = config('sms.smsq.sender_id');
        $this->baseUrl = config('sms.smsq.base_url');
    }

    public function from($senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function to($to)
    {
      $this->to = $to;

         return $this;
    }

    public function line($line = ''): self
    {
       $this->lines[] = $line;

       return $this;
    }

    public function send(): mixed
    {
        if (!$this->senderId || !$this->to || !count($this->lines)) {
            throw new \Exception('SMS not correct.');
        }

       $response = Http::acceptJson()->post($this->baseUrl.'SendSMS', [
            'ApiKey' => $this->apiKey,
            'ClientId' => $this->clintId,
            'SenderId' => $this->senderId,
            'Message' => collect($this->lines)->join("\n", ""),
            'MobileNumbers' => $this->to,
            'Is_Unicode' => true,
        ]);
        Log::emergency($this->to);
        Log::emergency($response->body());
        return $response;
    }

}
