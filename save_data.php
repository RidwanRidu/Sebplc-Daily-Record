<?php
require_once 'config.php';

// Get POST data
$data = [
    'entry_date' => $_POST['date'],
    'total_account' => (int)$_POST['totalAccount'],
    'sb' => (int)$_POST['sb'],
    'student' => (int)$_POST['student'],
    'cd' => (int)$_POST['cd'],
    'dps' => (int)$_POST['dps'],
    'fdr' => (int)$_POST['fdr'],
    'remittance' => (int)$_POST['remittance'],
    'cheque_book' => (int)$_POST['chequeBook'],
    'card' => (int)$_POST['card'],
    'rtgs' => (int)$_POST['rtgs'],
    'eft' => (int)$_POST['eft'],
    'total_deposit' => (float)$_POST['totalDeposit'],
    'total_withdraw' => (float)$_POST['totalWithdraw'],
    'hand_cash' => (float)$_POST['handCash'],
    'mother_balance' => (float)$_POST['motherBalance'],
    'dps_close' => (int)$_POST['dpsClose'],
    'fdr_close' => (int)$_POST['fdrClose'],
    'total_close_account' => (int)$_POST['totalCloseAccount']
];

// Check if entry already exists for this date
$checkSql = "SELECT id FROM outlet_data WHERE entry_date = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("s", $data['entry_date']);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    // Update existing record
    $row = $result->fetch_assoc();
    $updateSql = "UPDATE outlet_data SET 
        total_account = ?, sb = ?, student = ?, cd = ?, dps = ?, fdr = ?,
        remittance = ?, cheque_book = ?, card = ?, rtgs = ?, eft = ?,
        total_deposit = ?, total_withdraw = ?, hand_cash = ?, mother_balance = ?,
        dps_close = ?, fdr_close = ?, total_close_account = ?
        WHERE id = ?";
    
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param(
        "iiiiiiiiiiiddddiii",
        $data['total_account'], $data['sb'], $data['student'], $data['cd'], 
        $data['dps'], $data['fdr'], $data['remittance'], $data['cheque_book'], 
        $data['card'], $data['rtgs'], $data['eft'], $data['total_deposit'], 
        $data['total_withdraw'], $data['hand_cash'], $data['mother_balance'], 
        $data['dps_close'], $data['fdr_close'], $data['total_close_account'],
        $row['id']
    );
    
    if ($updateStmt->execute()) {
        echo "Data updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Insert new record
    $insertSql = "INSERT INTO outlet_data (
        entry_date, total_account, sb, student, cd, dps, fdr,
        remittance, cheque_book, card, rtgs, eft,
        total_deposit, total_withdraw, hand_cash, mother_balance,
        dps_close, fdr_close, total_close_account
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param(
        "siiiiiiiiiiiddddiii",
        $data['entry_date'], $data['total_account'], $data['sb'], $data['student'], 
        $data['cd'], $data['dps'], $data['fdr'], $data['remittance'], 
        $data['cheque_book'], $data['card'], $data['rtgs'], $data['eft'], 
        $data['total_deposit'], $data['total_withdraw'], $data['hand_cash'], 
        $data['mother_balance'], $data['dps_close'], $data['fdr_close'], 
        $data['total_close_account']
    );
    
    if ($insertStmt->execute()) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $insertStmt->error;
    }
}

$conn->close();
header("Location: index.php");
exit();
?>