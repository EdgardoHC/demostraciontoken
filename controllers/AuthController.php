<?php
require_once './models/User.php';
require_once './core/jwt.php';

class AuthController {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function register() {
        $data = json_decode(file_get_contents("php://input"), true);
        $user = new User($this->db);
        $user->email = $data['email'] ?? '';
        $user->password = password_hash($data['password'] ?? '', PASSWORD_DEFAULT);

        if ($user->create()) {
            echo json_encode(["mensaje" => "Registrado con éxito"]);
        } else {
            echo json_encode(["error" => "No se pudo registrar"]);
        }
    }

    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);
        $user = new User($this->db);
        $u = $user->findByEmail($data['email'] ?? '');

        if ($u && password_verify($data['password'], $u['password'])) {
            $jwt = new JWTHandler();
            $token = $jwt->generate(['id' => $u['id'], 'email' => $u['email']]);
            echo json_encode(["token" => $token]);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Credenciales inválidas"]);
        }
    }
}
