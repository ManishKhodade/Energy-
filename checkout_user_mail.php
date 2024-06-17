<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Contacting Us</title>
</head>
<body>
    <h1>Thank You for Contacting Us</h1>
    <p>Dear <?= esc($checkoutData['full_name']); ?>,</p>
    <p>Thank you for your purchase. Here are the details of your order:</p>

    <h2>Checkout Details</h2>
    <p><strong>Full Name:</strong> <?= esc($checkoutData['full_name']); ?></p>
    <p><strong>Email:</strong> <?= esc($checkoutData['email_id']); ?></p>
    <p><strong>Company Name:</strong> <?= esc($checkoutData['company']); ?></p>
    <p><strong>Contact Number:</strong> <?= esc($checkoutData['contact_no']); ?></p>
    <p><strong>Job Role:</strong> <?= esc($checkoutData['city']); ?></p>
    <p><strong>Country:</strong> <?= esc($checkoutData['country']); ?></p>
    <p><strong>Submitted On:</strong> <?= esc($checkoutData['date']); ?></p>

    <h2>Cart Contents</h2>
    <ul>
        <?php foreach ($cartData as $item) : ?>
            <li>
                <strong>Report ID:</strong> <?= esc($item['report_id']); ?><br>
                <strong>Report Title:</strong> <?= esc($item['rep_title']); ?><br>
                <strong>License Key:</strong> <?= esc($item['license_key']); ?><br>
                <strong>License Value:</strong> $<?= esc($item['license_value']); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <p>We will process your order shortly. If you have any questions, feel free to contact us.</p>

    <p>Best regards,<br>Manish Khodade</p>
</body>
</html>
