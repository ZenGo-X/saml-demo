<html>

<body>
    <?php
    $fp = fopen("/tmp/lock.txt", "w");

    if (flock($fp, LOCK_EX)) {  // acquire an exclusive lock


        $message_port = 9000;
        $response_port = 10000;
        $address = "server.signer";
        $message = "hello";

        // send the message
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
            exit(1);
        }
        $result = socket_connect($socket, $address, $message_port);
        while ($result === false) {
            sleep(1);
            $result = socket_connect($socket, $address, $message_port);
        }

        $message = bin2hex($message);
        socket_write($socket, $message, strlen($message));
        socket_close($socket);

        // get the response
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
            exit(1);
        }
        sleep(1);
        $result = socket_connect($socket, $address, $response_port);
        while ($result === false) {
            sleep(1);
            $result = socket_connect($socket, $address, $response_port);
        }

        $resp = socket_read($socket, 10000);
        socket_close($socket);
        echo $resp;
    };
    sleep(1);
    fclose($fp);
    ?>
</body>

</html>