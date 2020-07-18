<?php
class programLogic{
    /**
     * simple method to encrypt or decrypt a plain text string
     * initialization vector(IV) has to be the same when encrypting and decrypting
     * 
     * @param string $action: can be 'encrypt' or 'decrypt'
     * @param string $string: string to encrypt or decrypt
     *
     * @return string
     */
    //Connection a n'importe quelle bdd
    function connection($dbname){
        $db;
        $dsn = "mysql:host=localhost;dbname=$dbname;charset=utf8mb4";
        $options = [
        PDO::ATTR_EMULATE_PREPARES => false, //turn off emulation mode for 'real' prepared stmts
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // make the default fetch be an associative array
        ];

        try {
            $db = new PDO($dsn,"root","",$options);
        } catch (Exception $e) {
            error_log($d->getMessage());
            exit("Something weird happenned");
        }

    }
    function encrypt_decrypt($action, $string) 
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    function protect($adr)
    {
        $codedAdress = "";
        for($i=0; $i<strlen($adr); $i++)
            $codedAdress.="&#".ord(substr($adr, $i, 1)).";";
        return $codedAdress;
    }

    function approximateEmail($eml,$db)
    {
    }

    function isPassValid($pass)
    {
        // if(preg_match("#^[a-zA-Z0-9._-]{8,}#", $pass)){
        //     return true;
        // }
        if(preg_match("#^[a-z]{5,}#", $pass)){
            return true;
        }
        else{
            return false;
        }
    }

    function isEmailValid($mail)
    {
        if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)){
            return true;
        }
        else{
            return false;
        }
    }
}

?>