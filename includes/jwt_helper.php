<?php
class JWT {
    private static function get_secret() {
        if (defined('JWT_SECRET')) return JWT_SECRET;
        return 'default_secret_key_change_me';
    }

    public static function encode($payload) {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $base64UrlHeader = self::base64UrlEncode($header);
        $base64UrlPayload = self::base64UrlEncode(json_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::get_secret(), true);
        $base64UrlSignature = self::base64UrlEncode($signature);
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    public static function decode($jwt) {
        $tokenParts = explode('.', $jwt);
        if (count($tokenParts) != 3) return false;
        
        $signatureProvided = $tokenParts[2];
        $base64UrlHeader = $tokenParts[0];
        $base64UrlPayload = $tokenParts[1];

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::get_secret(), true);
        $base64UrlSignature = self::base64UrlEncode($signature);

        if ($base64UrlSignature === $signatureProvided) {
            $payload = base64_decode(str_replace(['-', '_'], ['+', '/'], $base64UrlPayload));
            return json_decode($payload, true);
        }
        return false;
    }

    private static function base64UrlEncode($data) {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }
}
?>
