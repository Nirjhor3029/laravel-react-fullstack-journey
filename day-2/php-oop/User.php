<?php

/*
    Topic 3: Parent Keyword
    Parent method reuse + extend.
*/

class User
{
    public function greet()
    {
        return "Hello";
    }
}

class Admin extends User
{
    public function greet()
    {
        return parent::greet() . " Admin";
    }
}
