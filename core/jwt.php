<?php
require_once  './vendor/autoload.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JWTHandler {
    private $key = "CLAVE_SECRETA_123";
    /*algoritmo simétrico, lo que quiere decir que se usa la misma clave secreta 
    tanto para firmar como para verificar el token.
    se refiere al algoritmo de firma que se utiliza para crear y verificar el token JWT (JSON Web Token).
    **/
    private $algo = 'HS256';

    public function generate($data, $exp = 3600) {
        $payload = [
            'iat' => time(),
            'exp' => time() + $exp,
            'data' => $data
        ];
        return JWT::encode($payload, $this->key, $this->algo);
    }

    public function validate($token) {
        return JWT::decode($token, new Key($this->key, $this->algo));
    }
}
