<?php

namespace App\Services\MapfreService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EncryptionPasswordServices
{
    public function encryptPassword($password)
    {
        // Convert the password to an array of bytes
        $data = [];
        for ($i = 0; $i < strlen($password); $i++) {
            $data[] = ord($password[$i]);
        }

        // Convert the byte array to a string
        $dataString = implode('', array_map('chr', $data));

        // Compute the SHA512 hash
        $hash = hash('sha512', $dataString, true);

        // Encode the hash in Base64
        $encryptedPassword = base64_encode($hash);

        return $encryptedPassword;
    }
    //     $password = 'your_password_here';
    // $encryptedPassword = $this->encryptPassword($password);
    // echo $encryptedPassword;
}
