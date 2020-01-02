<?php

namespace App\Models;

class User
{
    protected $id;
    protected $name;
    protected $username;
    protected $password;
    protected $email;

    public function __construct(array $values = [])
    {
        $this->id = isset($values['id']) ? intval($values['id']) : null;
        $this->name = isset($values['name']) ? $values['name'] : null;
        $this->email = isset($values['email']) ? $values['email'] : null;
        $this->username = isset($values['username']) ? $values['username'] : null;
        $this->password = isset($values['password']) ? $values['password'] : null;
    }

    public function setId($value)
    {
        $this->id = intval($value);
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function setUsername($value)
    {
        $this->username = $value;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
        ];
    }
}
