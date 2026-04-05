<?php

class User
{
    private array $methods = [];

    public function __call($name, $arguments)
    {
        $this->methods[$name] = $arguments;
        return $this;
    }

    public static function __callStatic($name, $arguments)
    {
        echo "Static call: $name\n";
    }
}

$user = new User();
$user->setName("Nirjhor")
    ->setEmail("nirjhor@example.com");

print_r($user);

echo "<br>";
// Static magic method
User::customMethod();
echo "<br>";

User::anythingStatic();
