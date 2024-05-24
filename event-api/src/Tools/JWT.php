<?php

declare(strict_types=1);

namespace App\Tools;

use OpenSSLAsymmetricKey;
use Firebase\JWT\JWT as JWTBase;
use Dotenv\Dotenv;
class JWT
{

    private OpenSSLAsymmetricKey $keys;
    private string $privateKey = "";
    private string $publicKey = "";
    private \stdClass $token;

    private string $data;
    private array $payload = [];

    /**
     * @throws \Exception
     */
    private function generateKeys(array $config = null) {
        $config = $config ?? [
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];
        $this->keys = openssl_pkey_new($config);
        $this->publicKey =  openssl_pkey_get_details($this->keys)['key'];
        openssl_pkey_export($this->keys,$this->privateKey);
    }

    public function create(): void {
        $this->generateKeys();
    }

    public function getPublicKey(): string {
        return $this->publicKey;
    }

    /**
     * @throws \Exception
     */
    public function getPrivateKey(): string {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        if (!isset($_ENV['PRIVATE_KEY'])) {
            $this->generateKeys();
            file_put_contents('/var/www/html/.env', 'PRIVATE_KEY="' . $this->privateKey . "\"\n", FILE_APPEND);
        } else {
            $this->privateKey = $_ENV['PRIVATE_KEY'];
        }

        return $this->privateKey;
    }

    public function decode(
    ){
        $this->token = JWTBase::decode($this->token, ["0" => $this->privateKey]);
    }

    public function addPayload(array $newPayload): void {
        $this->payload = array_merge($this->payload, $newPayload);
    }

    public function encode(): void {
        if(!$this->privateKey) {
            $this->getPrivateKey();
        }
        $this->data =  JWTBase::encode($this->payload, $this->privateKey,'RS256');
    }

    public function getToken(): \stdClass {
        return $this->token;
    }

    public function getJWT(): string {
        return $this->data;
    }
}