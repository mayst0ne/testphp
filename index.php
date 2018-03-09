<?php

$sqlinput = [];

foreach ($argv as $index => $value) {
    if($index > 0) {
        $params = str_replace('-', '', $value);
        $paramsExploded = explode('=', $params);

        $usernameOptions = ['u'];
        if(in_array($paramsExploded[0], $usernameOptions)) {
            $paramsExploded[0]='username';
        }
        $emailOptions = ['e'];
        if(in_array($paramsExploded[0], $emailOptions)) {
            $paramsExploded[0]='email';
        }
        $noteOptions = ['n'];
        if(in_array($paramsExploded[0], $noteOptions)) {
            $paramsExploded[0]='note';
        }
        $avgOptions = ['a'];
        if(in_array($paramsExploded[0], $usernameOptions)) {
            $paramsExploded[0]='average';
        }

        $sqlinput[$paramsExploded[0]] = $paramsExploded[1];
}

}

$sqlcount=var_dump(count($sqlinput));
var_dump($sqlinput);



define('DS', DIRECTORY_SEPARATOR);

function currentPath(string $fileName): string {
     $path = array(
         __DIR__,
         $fileName
     );
     return implode(DS, $path);
}
$path = currentPath('config.ini');
if(file_exists($path)) {
     $strings = array();
     $resource = fopen($path, 'r');
     if($resource) {
         while (($string = fgets($resource, 4096)) !== false) {
             $strings[] = trim($string);
         }
         fclose($resource);
     }
     $config = array();
     foreach ($strings as $string) {
         $paramsExploded = explode('=', $string);
         $config[$paramsExploded[0]] = $paramsExploded[1];
     }
}
extract($config);

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$database",
        $username,
        $passwd);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($sqlinput) {


      $query = sprintf("SELECT count(id) as n FROM users WHERE email = '%s'", $sqlinput['email']);
      $stmt = $pdo->query($query);
      $nUsers = $stmt->fetch(PDO::FETCH_ASSOC);

      if(($nUsers['n'] == 0)) {
          $sql = sprintf("INSERT INTO users (username, email, note) VALUES ('%s', '%s', '%s')", $sqlinput['username'], $sqlinput['email'], $sqlinput['note']);
          $pdo->exec($sql);
          var_dump(sprintf("Last insert id: %s", $pdo->lastInsertId()));
      }

      if($sqlinput['id']!= null ) {
          $sql = sprintf("UPDATE users SET note= ('%s') WHERE (id)=('%s')" ,$sqlinput['note'],$sqlinput['id']);
          $pdo->exec($sql);
          var_dump(sprintf("Last insert id: %s", $pdo->lastInsertId()));
      }

      if($sqlinput['email']!= null ) {
          $sql = sprintf("UPDATE users SET note= ('%s') WHERE (email)=('%s')" ,$sqlinput['note'],$sqlinput['email']);
          $pdo->exec($sql);
          var_dump(sprintf("Last insert id: %s", $pdo->lastInsertId()));
      }


      else {
          var_dump(sprintf("L'utilisateur '%s' est déjà existant.", $sqlinput['email']));
      }


    }
    if($paramsExploded[0]='average') {
        $sql = 'SELECT AVG(note) AS average FROM users';
        $pdo->query($sql);
        var_dump(sprintf("Last insert id: %s", $pdo->lastInsertId()));
        var_dump($pdo);
        $stmt = $pdo->query($sql);
        $avg=$stmt->fetch();

        var_dump(sprintf('La moyenne est de %s', $avg['average']));
    }


    var_dump($pdo);
} catch (PDOException $e) {
    var_dump($e);
    var_dump("Same player, try again");
} finally {
    $pdo = null;
}
