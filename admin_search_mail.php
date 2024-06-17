<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Data Received</title>
</head>
<body>
    <h2>Search Data Received</h2>
    <p>Hello Admin,</p>
    <p>You have received a new search request with the following details:</p>
    <table border="1">
        <tr>
            <td><strong>Topic:</strong></td>
            <td><?= $topic ?></td>
        </tr>
        <tr>
            <td><strong>Full Name:</strong></td>
            <td><?= $full_name ?></td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td><?= $email_id ?></td>
        </tr>
        <tr>
            <td><strong>Message:</strong></td>
            <td><?= $message ?></td>
        </tr>
        <tr>
            <td><strong>Code:</strong></td>
            <td><?= $code ?></td>
        </tr>
    </table>
    <p>Thank you.</p>
</body>
</html>
