<!DOCTYPE html>
<html>
<head>
    <title>New Checkout Form Submission</title>
    
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>New Checkout Form Submission</h1>

    <h2>Cart Contents</h2>
    <table>
        <tr>
            <th>Report ID</th>
            <th>Report Title</th>
            <th>License Key</th>
            <th>License Value</th>
        </tr>
        <?php foreach ($cartData as $item) : ?>
            <tr>
                <td><?= esc($item['report_id']); ?></td>
                <td><?= esc($item['rep_title']); ?></td>
                <td><?= esc($item['license_key']); ?></td>
                <td>$<?= esc($item['license_value']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <table>
        <tr>
            <th>Field</th>
            <th>Details</th>
        </tr>
        <tr>
            <td><strong>Full Name:</strong></td>
            <td><?= esc($checkoutData['full_name']); ?></td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td><?= esc($checkoutData['email_id']); ?></td>
        </tr>
        <tr>
            <td><strong>Company Name:</strong></td>
            <td><?= esc($checkoutData['company']); ?></td>
        </tr>
        <tr>
            <td><strong>Contact Number:</strong></td>
            <td><?= esc($checkoutData['contact_no']); ?></td>
        </tr>
        <tr>
            <td><strong>Job Role:</strong></td>
            <td><?= esc($checkoutData['city']); ?></td>
        </tr>
        <tr>
            <td><strong>Country:</strong></td>
            <td><?= esc($checkoutData['country']); ?></td>
        </tr>
        <tr>
            <td><strong>Submitted On:</strong></td>
            <td><?= esc($checkoutData['date']); ?></td>
        </tr>
    </table>


</body>
</html>
