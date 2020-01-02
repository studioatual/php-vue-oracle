<?php

define('HOST', 'oracledb');
define('PORT', 1521);
define('DATABASE', 'XE');

$userAdmin = 'system';
$passAdmin = 'oracle';

$tableSpace = 'tbs_citroflavor';
$fileDatabase = 'citroflavor.dbf';
$username = "citroflavor";
$password = "oracle";
$role = "dev_profile";

function getConnection($user, $pass)
{
    $tns = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS="
        . "(PROTOCOL=TCP)(HOST=".HOST.")"
        . "(PORT=".PORT.")))"
        . "(CONNECT_DATA=(SERVER=DEDICATED)"
        . "(SERVICE_NAME=".DATABASE.")))";
    try {
        $pdo = new PDO("oci:dbname=".$tns, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

function executeQuery($user, $pass, $query)
{
    try {
        $conn = getConnection($user, $pass);
        $result = $conn->query($query);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

echo '// Cria tablespace';
$query = "create tablespace ".$tableSpace."
    datafile '/u01/app/oracle/oradata/XE/".$fileDatabase."' size 10M reuse
    autoextend on next 1M maxsize 200M
    online";
executeQuery($userAdmin, $passAdmin, $query);


echo '// Cria o usuario';
$query = 'create user '.$username.'
    identified by "'.$password.'"
    default tablespace '.$tableSpace.'
    temporary tablespace temp';
executeQuery($userAdmin, $passAdmin, $query);


echo '// Cria a role';
$query = "create role ".$role;
executeQuery($userAdmin, $passAdmin, $query);


echo '// Define os privilegios da role';
$query = "grant
    create cluster,
    create database link,
    create procedure,
    create session,
    create sequence,
    create synonym,
    create table,
    create any type,
    create trigger,
    create view
    to ".$role;
executeQuery($userAdmin, $passAdmin, $query);


echo '// Atribui a "role" ao usuario';
$query = "grant ".$role." to ".$username;
executeQuery($userAdmin, $passAdmin, $query);


echo '// Define "unlimited" tablespace para o usuario';
$query = "grant unlimited tablespace to ".$username;
executeQuery($userAdmin, $passAdmin, $query);


echo '// Create Table Users';
$query = "CREATE TABLE USERS (
        ID INTEGER NOT NULL,
        NAME VARCHAR2(100) NOT NULL,
        EMAIL VARCHAR2(100) NOT NULL,
        USERNAME VARCHAR2(40) NOT NULL,
        PASSWORD VARCHAR2(255) NOT NULL,
        CREATED_AT TIMESTAMP NOT NULL,
        UPDATED_AT TIMESTAMP,
        PRIMARY KEY (ID)
    )";
executeQuery($username, $password, $query);


echo '// Insert User Test';

$query = "INSERT INTO USERS (
        ID,
        NAME,
        EMAIL,
        USERNAME,
        PASSWORD,
        CREATED_AT
    ) VALUES (
        1,
        'User Test',
        'test@test.com',
        'test',
        '".password_hash('123456', PASSWORD_DEFAULT)."',
        LOCALTIMESTAMP
    )";
executeQuery($username, $password, $query);


echo '// Create Table Stock';
$query = "CREATE TABLE STOCK (
        TAG VARCHAR2(20) NOT NULL,
        DESCRICAO VARCHAR2(100) NOT NULL,
        CUSTO_MEDIO DECIMAL(8,2) NOT NULL,
        QUANTIDADE_KG DECIMAL(8,3) NOT NULL,
        CREATED_AT TIMESTAMP NOT NULL,
        UPDATED_AT TIMESTAMP,
        PRIMARY KEY (TAG)
    )";
executeQuery($username, $password, $query);


echo '// Insert Itens Stock';

$stock_list = json_decode('[
    {
      "tag": "ABC",
      "descricao": "AGUA DE SALES 500ML",
      "custo_medio": "0",
      "quantidade_kg": "145"
    },
    {
      "tag": "CP125",
      "descricao": "COPO 200ML",
      "custo_medio": "5.71",
      "quantidade_kg": "680.5"
    },
    {
      "tag": "FN1LT",
      "descricao": "FRUPIC NECTAR 1 LT",
      "custo_medio": "0",
      "quantidade_kg": "1"
    },
    {
      "tag": "PROD",
      "descricao": "PRODUTO TESTE",
      "custo_medio": "11.68",
      "quantidade_kg": "24"
    },
    {
      "tag": "0261230081",
      "descricao": "SENSOR DE PRESSAO",
      "custo_medio": "2",
      "quantidade_kg": "91"
    },
    {
      "tag": "0281002149",
      "descricao": "VALVULA DE ELETROIMA",
      "custo_medio": "238.6",
      "quantidade_kg": "6"
    },
    {
      "tag": "11 0 74 B",
      "descricao": "AGROMAT TESTE",
      "custo_medio": "7.05",
      "quantidade_kg": "12"
    },
    {
      "tag": "11023",
      "descricao": "ITEM DE TESTE DE PRECO DE VENDA",
      "custo_medio": "10",
      "quantidade_kg": "0"
    },
    {
      "tag": "11056",
      "descricao": "FRETE",
      "custo_medio": "30",
      "quantidade_kg": "4"
    },
    {
      "tag": "11065",
      "descricao": "IMPORTACAO 001",
      "custo_medio": "2.5",
      "quantidade_kg": "100"
    },
    {
      "tag": "11066",
      "descricao": "IMPORTACAO 002",
      "custo_medio": "2.5",
      "quantidade_kg": "100"
    },
    {
      "tag": "11125",
      "descricao": "NECTAR DE MANGA FATTO BENE",
      "custo_medio": "1.4",
      "quantidade_kg": "199"
    },
    {
      "tag": "11229",
      "descricao": "ELETRODO 7018",
      "custo_medio": "12",
      "quantidade_kg": "45"
    },
    {
      "tag": "115EM",
      "descricao": "EMBALAGEM",
      "custo_medio": "3.02",
      "quantidade_kg": "1504"
    },
    {
      "tag": "1154",
      "descricao": "COPO",
      "custo_medio": "0",
      "quantidade_kg": "17"
    },
    {
      "tag": "116",
      "descricao": "CAIXA DE PAPELAO",
      "custo_medio": "0",
      "quantidade_kg": "10000015.95"
    },
    {
      "tag": "119",
      "descricao": "FRASCO DE OLEO",
      "custo_medio": "15",
      "quantidade_kg": "0"
    },
    {
      "tag": "123456789101112",
      "descricao": "MAO DE OBRA",
      "custo_medio": "100",
      "quantidade_kg": "1"
    },
    {
      "tag": "133",
      "descricao": "QUEIJO MINAS",
      "custo_medio": null,
      "quantidade_kg": "500"
    }
  ]');


$conn = getConnection($username, $password);

$sql = "INSERT INTO STOCK (TAG, DESCRICAO, CUSTO_MEDIO, QUANTIDADE_KG, CREATED_AT)
        VALUES (:tag, :descricao, :custo_medio, :quantidade_kg, LOCALTIMESTAMP)";

$query = $conn->prepare($sql);

foreach ($stock_list as $item) {
    $query->execute([
            'tag' => $item->tag,
            'descricao' => $item->descricao,
            'custo_medio' => $item->custo_medio,
            'quantidade_kg' => $item->quantidade_kg
        ]);
}

