<?php

// Połączenie z bazą danych
$host = 'localhost';
$user = 'root'; // Nazwa użytkownika bazy danych
$password = ''; // Hasło użytkownika bazy danych
$database = 'ERP'; // Nazwa bazy danych

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Funkcja do odczytu danych klientów z bazy danych
function readCustomersData() {
    global $connection;

    $customersData = [];

    $query = "SELECT * FROM customers";
    $result = mysqli_query($connection, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $customersData[] = $row;
        }
    }

    return $customersData;
}

// Funkcja do zapisu danych klientów do bazy danych
function saveCustomersData($customersData) {
    global $connection;

    foreach ($customersData as $customer) {
        $id = mysqli_real_escape_string($connection, $customer['id']);
        $name = mysqli_real_escape_string($connection, $customer['name']);
        $email = mysqli_real_escape_string($connection, $customer['email']);
        $subscription = mysqli_real_escape_string($connection, $customer['subscription']);

        $query = "INSERT INTO customers (id, name, email, subscription) VALUES ('$id', '$name', '$email', '$subscription')";
        mysqli_query($connection, $query);
    }
}

// Funkcja do dodawania nowego klienta
function addCustomer($name, $email, $subscription) {
    global $connection;

    // Generowanie losowego identyfikatora klienta
    $customerId = uniqid();

    // Tworzenie nowego klienta
    $newCustomer = [
        'id' => $customerId,
        'name' => $name,
        'email' => $email,
        'subscription' => $subscription
    ];

    // Dodawanie nowego klienta do tablicy klientów
    $customersData = readCustomersData();
    $customersData[] = $newCustomer;

    // Zapisanie danych klientów
    saveCustomersData($customersData);

    return $customerId;
}

// Funkcja do aktualizacji danych klienta
function updateCustomer($customerId, $name, $email, $subscription) {
    global $connection;

    $query = "UPDATE customers SET name='$name', email='$email', subscription='$subscription' WHERE id='$customerId'";
    mysqli_query($connection, $query);
}

// Funkcja do usuwania klienta
function deleteCustomer($customerId) {
    global $connection;

    $query = "DELETE FROM customers WHERE id='$customerId'";
    mysqli_query($connection, $query);
}

// Funkcja do pobierania adresów e-mail klientów
function getEmailAddresses() {
    global $connection;

    $emailAddresses = [];

    $query = "SELECT email FROM customers";
    $result = mysqli_query($connection, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $emailAddresses[] = $row['email'];
        }
    }

    return implode(', ', $emailAddresses);
}

// Wywołanie funkcji w zależności od akcji przesłanej z formularza
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["option"])) {
        switch ($_POST["option"]) {
            case "1": // Dodaj nowego klienta
                if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["subscription"])) {
                    $customerId = addCustomer($_POST["name"], $_POST["email"], $_POST["subscription"]);
                    echo "Nowy klient został dodany. ID klienta: $customerId";
                } else {
                    echo "Wszystkie pola są wymagane.";
                }
                break;
            case "2": // Wyświetl wszystkich klientów
                $customers = getAllCustomers();
                if (!empty($customers)) {
                    echo "<h2>Lista klientów:</h2>";
                    echo "<ul>";
                    foreach ($customers as $customer) {
                        echo "<li>ID: {$customer['id']}, Imię: {$customer['name']}, Email: {$customer['email']}, Subskrypcja: {$customer['subscription']}</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "Brak klientów.";
                }
                break;
            case "3": // Aktualizuj dane klienta
                if (isset($_POST["customerId"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["subscription"])) {
                    updateCustomer($_POST["customerId"], $_POST["name"], $_POST["email"], $_POST["subscription"]);
                    echo "Dane klienta zostały zaktualizowane.";
                } else {
                    echo "Wszystkie pola są wymagane.";
                }
                break;
            case "4": // Usuń klienta
                if (isset($_POST["customerId"])) {
                    deleteCustomer($_POST["customerId"]);
                    echo "Klient został usunięty.";
                } else {
                    echo "Nieprawidłowy identyfikator klienta.";
                }
                break;
            case "5": // Pobierz adresy e-mail klientów
                $emailAddresses = getEmailAddresses();
                echo "Adresy e-mail klientów: $emailAddresses";
                break;
            default:
                echo "Nieprawidłowa opcja.";
        }
    } else {
        echo "Nie wybrano opcji.";
    }
} else {
    echo "Nieprawidłowe żądanie.";
}

?>
