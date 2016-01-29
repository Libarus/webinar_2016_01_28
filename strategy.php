<?php

// Создаём интерфейс
interface IUser
{
    function getName();
}

class UserDb implements IUser
{
    public function __construct( $id ) { }
    public function getName()
    {
        return "User from database /strategy/";
    }
}

class UserFile implements IUser
{
    public function __construct( $id ) { }
    public function getName()
    {
        return "User from filebase /strategy/";
    }
}

class UserFactory
{
    public function getName($id)
    {
        if ($id > 1000)
            $obj = new UserDb( $id );
        else
            $obj = new UserFile( $id );
        
        return $obj->getName();
    }
}

$uo = new UserFactory();
echo $uo->getName(2000)."<br>";
echo $uo->getName(500)."<br>";
