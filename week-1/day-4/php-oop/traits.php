<?php

trait Logger
{
    public function log($message)
    {
        echo "[" . date('Y-m-d H:i:s') . "] $message\n";
        // echo "Log: $message ";
        // echo date("Y-m-d H:i:s") . ": $message";
        // echo "<br>";
    }
}

trait Timestamper
{
    public function timestamp()
    {
        return date('Y-m-d H:i:s');
    }
}

class User
{
    use Logger,  Timestamper;
}

class Admin
{
    use Logger;
}

$user = new User();
$user->log("User logged in");
echo $user->timestamp();
echo "<br>";

$admin = new Admin();
$admin->log("Admin logged in");

/*
Output:
Log: User logged in
Log: Admin logged in
*/