<?php

namespace App\Auth;

use PDO;
use App\Models\User;

class Auth
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->get($property)) {
            return $this->container->get($property);
        }
    }

    public function attemptAuthentication($params)
    {
        $sql = 'SELECT * FROM USERS WHERE ';
        $i = 0;
        $fields = [];

        foreach ($params as $key=>$value) {
            if ($key != 'password') {
                $sql .= $i == 0 ? '' : ' AND ';
                $sql .= strtoupper($key) . ' = :' . $key;
                $fields[$key] = $value;
            }
            $i++;
        }

        $query = $this->db->prepare($sql);
        $query->execute($fields);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }

        $user = new User($result);

        if (!isset($params['password'])) {
            return $user;
        }

        return $this->checkPasswordIsMatch($user, $params['password']);
    }

    public function checkPasswordIsMatch($user, $password)
    {
        if (!password_verify($password, $user->getPassword())) {
            $this->error = 'Senha inválida!';
            return false;
        }

        return $user;
    }
}
