<?php
class User
{

    public $loginSuccess = false;
    public $content = false;

    public function __construct($user = null, $pass = null)
    {
        $db = new Conn;
        $sql = 'SELECT username, password FROM user WHERE username = :username AND password = :password';
        $sth = $db->pdo->prepare($sql);
        $sth->bindParam(':username', $user);
        $sth->bindParam(':password', $pass);
        $sth->execute();

        $result = $sth->fetchAll(PDO:: FETCH_ASSOC);
        $result = array_shift($result);

        if ($sth->rowCount() > 0) {
            $this->loginSuccess = true;
            $this->content = $result;
        } else {
            $this->loginSuccess = false;
        }
    }
}
