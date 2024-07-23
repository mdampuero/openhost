<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com>.
//  Copyright. All rights reserved.
//

namespace App\BackEndBundle\Service;


/**
 * Class Chatgpt
 *
 * @package App\BackEndBundle\Service
 */
class Chatgpt
{
    private $setting;
    private $httpClient;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function getSEOImprovements(string $content): string
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "model" => "gpt-3.5-turbo",
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $content
                ]
            ]
        ]));

        $headers = [
            'Authorization: Bearer ' . $this->setting->getData()->getApiKey(),
            'Content-Type: application/json',
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('Error al hacer la solicitud: ' . curl_error($ch));
        }

        curl_close($ch);
        $response = json_decode($result, true);
        if(key_exists("error",$response)){
            throw new \Exception($response["error"]["message"]);
        }
        return $response['choices'][0]['message']['content'] ?? '';
    }
    
}
