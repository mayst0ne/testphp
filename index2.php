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

        $sqlinput[$paramsExploded[0]] = $paramsExploded[1];
}

}

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

      if($nUsers['n'] == 0) {
          $sql = sprintf("INSERT INTO users (username, email, note) VALUES ('%s', '%s', '%s')", $sqlinput['username'], $sqlinput['email'], $sqlinput['note']);
          $pdo->exec($sql);
          var_dump(sprintf("Last insert id: %s", $pdo->lastInsertId()));
      } else {
          var_dump(sprintf("L'utilisateur '%s' est déjà existant.", $sqlinput['email']));
      }


    }

    var_dump($pdo);
} catch (PDOException $e) {
    var_dump($e);
    var_dump("Same player, try again");
} finally {
    $pdo = null;
}
