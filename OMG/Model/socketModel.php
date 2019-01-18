<?php

// class socketModel
// {
    // return self::construirListaValidacionDocumento($rec);

    // public function socketInstance()
    // {
        $address = '192.168.1.72';
        $port = 8686;
        $sock;
        // echo "hola";
        if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) == false)
        {
            // echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
        }

        if (socket_bind($sock, $address, $port) == false)
        {
            // echo "socket_bind() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
        }

        if (socket_listen($sock, 5) == false)
        {
            // echo "socket_listen() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
        }
        while(true){};
        // sleep(3);
        // echo $sock;
        // socket_close($sock);
        // return $sock;
    // }
// }

?>