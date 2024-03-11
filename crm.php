<?php

// Funkcja do odczytu danych klientów z pliku
function readCustomersData() {
    $customersData = file_get_contents('crm_data.txt');
    return json_decode($customersData, true) ?: [];
}

// Funkcja do zapisu danych klientów do pliku
function saveCustomersData($customersData) {
    file_put_contents('crm_data.txt', json_encode($customersData));
}

// Operacja "Create" - Dodanie nowego klienta
function addCustomer($name, $email, $subscription) {
    $customersData = readCustomersData();
    
    // Generowanie losowego identyfikatora klienta
    $customerId = uniqid();

    // Tworzenie nowego klienta
    $newCustomer = array(
        'id' => $customerId,
        'name' => $name,
        'email' => $email,
        'subscription' => $subscription
    );

    // Dodawanie nowego klienta do tablicy klientów
    $customersData[] = $newCustomer;

    // Zapisanie danych klientów
    saveCustomersData($customersData);

    return $customerId;
}

// Operacja "Read" - Wyświetlenie wszystkich klientów
function getAllCustomers() {
    return readCustomersData();
}

// Operacja "Update" - Aktualizacja danych klienta
function updateCustomer($customerId, $name, $email, $subscription) {
    $customersData = readCustomersData();

    // Znalezienie klienta po identyfikatorze
    foreach ($customersData as &$customer) {
        if ($customer['id'] === $customerId) {
            // Aktualizacja danych klienta
            $customer['name'] = $name;
            $customer['email'] = $email;
            $customer['subscription'] = $subscription;
            break;
        }
    }

    // Zapisanie zaktualizowanych danych klientów
    saveCustomersData($customersData);
}

// Operacja "Delete" - Usunięcie klienta
function deleteCustomer($customerId) {
    $customersData = readCustomersData();

    // Usunięcie klienta z tablicy na podstawie identyfikatora
    foreach ($customersData as $key => $customer) {
        if ($customer['id'] === $customerId) {
            unset($customersData[$key]);
            break;
        }
    }

    // Zapisanie zaktualizowanych danych klientów
    saveCustomersData($customersData);
}

// Operacja "Pobierz adresy e-mail klientów"
function getEmailAddresses() {
    $customersData = readCustomersData();
    $emailAddresses = array_column($customersData, 'email');
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
