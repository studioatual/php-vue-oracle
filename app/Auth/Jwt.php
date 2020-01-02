<?php

namespace App\Auth;

class Jwt
{
    private $domain;
    private $key;

    public function __construct($domain, $key)
    {
        $this->domain = $domain;
        $this->key = $key;
    }

    public function generateToken($fields)
    {
        $header = $this->makeHeader();
        $payload = $this->makePayload($fields);
        $signature = $this->makeSignature($header, $payload);

        return "$header.$payload.$signature";
    }

    private function makeHeader()
    {
        return base64_encode(json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]));
    }

    private function makePayload($fields)
    {
        $payload['iss'] = $this->domain;
        foreach ($fields as $key=>$value) {
            $payload[$key] = $value;
        }
        return base64_encode(json_encode($payload));
    }

    private function makeSignature($header, $payload)
    {
        return base64_encode(hash_hmac(
            'sha256',
            $header.$payload,
            $this->key,
            true
        ));
    }

    public function checkToken($token)
    {
        $token = trim(str_replace("Bearer", "", $token));

        if (!$this->checkTokenIsNotEmpty($token)) {
            return false;
        }

        if (!$parts = $this->checkTokenParts($token)) {
            return false;
        }

        if (!$this->checkHeader($parts)) {
            return false;
        }

        if (!$payload = $this->checkPayload($parts)) {
            return false;
        }

        if (!$this->checkSignature($parts)) {
            return false;
        }

        return $payload;
    }

    private function checkTokenIsNotEmpty($token)
    {
        if ($token == "" || $token == null) {
            return false;
        }

        return true;
    }

    private function checkTokenParts($token)
    {
        $parts = explode('.', $token);
        if (count($parts) != 3) {
            return false;
        }

        return $parts;
    }

    private function checkHeader($parts)
    {
        if ($parts[0] !== $this->makeHeader()) {
            return false;
        }

        return true;
    }

    private function checkPayload($parts)
    {
        $payload = json_decode(base64_decode($parts[1]));

        if (!isset($payload->iss)) {
            return false;
        }

        return $payload;
    }

    private function checkSignature($parts)
    {
        return $parts[2] === $this->makeSignature($parts[0], $parts[1]);
    }
}
