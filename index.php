<?php

const DSN = 'mysql:host=localhost;dbname=iiko;charset=utf8mb4';
const DB_USER = 'root';
const DB_PASS = '';

include_once 'DbManager.php';
include_once 'BillService.php';
include_once 'BillStatusEnum.php';

try {
    $dbManager = new DbManager(DSN, DB_USER, DB_PASS);
    $billService = new BillService($dbManager);
    $bills = $billService->getByStatusAndCreated(
        BillStatusEnum::Paid, // оплаченные счета
        // созданные с указанной временной точки
        DateTime::createFromFormat("Y-m-d", "2025-01-01")
    );
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
} catch (Throwable $e) {
    echo $e->getMessage();
    exit();
}

print PHP_EOL . 'All done!';
echo '<pre>';
print_r($bills);
echo '</pre>';
