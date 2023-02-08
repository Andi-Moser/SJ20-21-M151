# Übung 2.1 #

> Reminder: Alle Übungen sollen in einem separaten Ordner abgelegt werden!

## Verbindung herstellen ##

1. Fügen Sie folgenden Code in der Datei ein. Passen Sie den Servernamen, Benutzernamen und Passwort entsprechend Ihrer Umgebung an.

    ```php
   <?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "northwind";
   
   $conn = mysqli_connect($servername, $username, $password);
   
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   
   echo "Connected successfully<br />";
   
   mysqli_select_db($conn, $database);
   
   echo "Datenbank ausgewählt!<br />";
    ?>
    ```

1. Schliessen Sie die Verbindung am Ende der Datei mit `mysqli_close($conn);`

## Queries ausführen ##

1. Fügen Sie folgenden Code an der entsprechenden Stelle ein:

    ```php
    $sql = "<<QUERY HIER EINFÜGEN>>";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      echo $result->num_rows . " Resultate";
    } else {
      echo "Keine Resultate vorhanden";
    }
    ```

1. Schreiben Sie ein SQL Query welches alle Kunden (Tabelle `customer`) ausliest und fügen sie es an der entsprechenden Stelle ein.
> `$sql = "<<QUERY HIER EINFÜGEN>>"`

### Aufgaben ###

- [ ] Dumpen (`var_dump($result);`) Sie das Resultat und interpretieren Sie das Resultat
- [ ] Schränken Sie das Query (`WHERE x = y`) so ein, dass nur Kunden welche `Purchasing Representative` als `job_title` haben.
