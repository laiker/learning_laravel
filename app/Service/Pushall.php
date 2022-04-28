<?php 

namespace App\Service;

class Pushall
{
    private $id;
    private $apiKey;

    protected $url =  "https://pushall.ru/api.php";

    public function __construct( $id, $apiKey)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
    }

    public function send($title, $text)
    {
        $data =  [
            "type" => "self",
            "id" => $this->id,
            "key" => $this->apiKey,
            "title" => $title,
            "text" => $text
        ];

        $client = new \GuzzleHttp\Client(['base_uri' => $this->url]);

        return $client->post('', ['form_params' => $data]);
        
        

        $result = curl_exec($ch); 
    
        curl_close($ch);

        return $result;
    }
}