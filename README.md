## Simple test

To test simple producer/consumer (send/receive).

Update `config.php` first.

Install packages, run in the terminal `composer install`.

Now test sending and receiving in 2 separate terminals:

```bash
php receive.php

#new terminal
php send.php
```

## Socat test

We want to test proxy connection in between a worker (`receive.php`) and rabbitmq, so that we can simulate gone connections via firewall. To do so we will use `socat` http://www.dest-unreach.org/socat/doc/socat.html#EXAMPLES

### Start

Update `config.php` first.

```bash
#socat will listen on port 35672 and forward to 5672 (rabbitmq), thus receiver's port will be set to 35672
socat TCP4-LISTEN:35672 TCP4:127.0.0.1:5672

#new terminal
php receive.php

#new terminal
php send.php
```

Then kill socat, and receive will crash.

