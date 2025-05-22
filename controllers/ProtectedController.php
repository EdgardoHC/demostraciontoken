<?php
require_once './core/jwt.php';

class ProtectedController {
    public function index() {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(["error" => "Token requerido"]);
            return;
        }

        $token = str_replace("Bearer ", "", $headers['Authorization']);
        try {
            $jwt = new JWTHandler();
            $decoded = $jwt->validate($token);
            echo json_encode(["mensaje" => "Acceso permitido", "usuario" => $decoded->data]);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(["error" => "Token inválido o expirado"]);
        }
    }
}
