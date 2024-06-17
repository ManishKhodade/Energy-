<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .linktag {
            font-size: 17px !important;
            padding: 10px 10px 4px 80px !important;
            background-color: #e3b04b !important;
        }
        .bottom-gap {
            padding: 0px 0px 8px 0px;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
    <!-- Include header.php -->
    <?php include('header.php'); ?>
</head>

<body>

<div class="col-md-12">
    <ol class="breadcrumb linktag">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>cart">Shopping Cart</a></li>
        <li class="breadcrumb-item active">Checkout</li>
    </ol>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3 navigation">
            <img src="<?= base_url() ?>assets/images/logo-new.png" alt="24chemical logo" title="24Chemical research" class="logo">
        </div>
        <div class="col-md-9">
            <ul class="pay-process">
                <li class="active">Report Page</li>
                <li class="active">Shop Cart</li>
                <li class="active">Checkout</li>
                <li>Payments</li>
                <li>Confirmation</li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php if (empty($cartContents)) : ?>
            <div class="col-md-12 text-center empty-cart">
                <h2 class="color"><strong>Your cart is empty!</strong></h2>
                <p class="text-muted">You have no items in your shopping cart. Please purchase a report.</p>
                <a href="<?= base_url() ?>letest-reports" class="btn-1"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;CONTINUE SHOPPING</a>
            </div>
        <?php else : ?>
            <div class="col-md-8">
                <form id="checkoutForm" action="<?= base_url('store') ?>" method="post" class="cust-form">
                    <h3 class="c-head">Checkout</h3>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-12">
                            <p>Select Payment Option :</p>
                            <label class="cut-radio"><input type="radio" name="pay_option" value="paypal" checked><span>PayPal</span></label>
                            <label class="cut-radio"><input type="radio" name="pay_option" value="wire-transfer"><span>Wire transfer</span></label>
                        </div>
                    </div>

                    <div>
                        <div class="row bottom-gap">
                            <div class="col-md-6 form-group">
                                <div class="cus-input">
                                    <input type="text" class="form-control" id="fname" placeholder="Enter Your Full Name" name="full_name" required />
                                    <div class="error-message" id="error-full-name"></div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="cus-input">
                                    <input type="email" class="form-control" id="email" placeholder="Enter Your Business E-mail" name="email" required />
                                    <div class="error-message" id="error-email"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row bottom-gap">
                            <div class="col-md-6 form-group">
                                <div class="cus-input">
                                    <input type="text" class="form-control" id="cname" placeholder="Enter Your Company Name" name="company_name" required />
                                    <div class="error-message" id="error-company-name"></div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="cus-input">
                                    <input type="tel" class="form-control" id="cnumber" placeholder="Enter Your Contact Number" name="contact_number" required pattern="\d{6,15}" />
                                    <div class="error-message" id="error-contact-number"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row bottom-gap">
                            <div class="col-md-6 form-group">
                                <div class="cus-input">
                                    <input type="text" class="form-control" id="jrole" placeholder="Enter Your Job Role" name="job_role" required />
                                    <div class="error-message" id="error-job-role"></div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="cus-input">
                                    <select class="form-control" id="country" name="country" required>
                                        <option value="">Select Your Country</option>
                                        <?php foreach ($countries as $country): ?>
                                            <option value="<?= esc($country['name']) ?> (+ <?= esc($country['phonecode']) ?>)"><?= esc($country['name']) ?> (+<?= esc($country['phonecode']) ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="error-message" id="error-country"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row bottom-gap">
                            <div class="col-md-6 form-group">
                                <div class="cus-input">
                                    <input type="text" class="form-control" id="userSecurityCode" placeholder="Enter Security Code" name="security_code" required />
                                    <div class="error-message" id="error-security-code"></div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="sec-code">
                                    <span id="generatedCode" style="font-size:24px;font-family:Segoe, &quot;Segoe UI&quot;, &quot;DejaVu Sans&quot;,&quot;Trebuchet MS&quot;, Verdana, sans-serif;"><?= $securityCode ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row bottom-gap">
                            <div class="col-md-12 form-group proceed">
                                <button type="submit">Proceed to payment <i class="fa fa-chevron-circle-right"></i></button>
                            </div>
                        </div>
                        <div class="row bottom-gap">
                            <div class="col-md-12 form-group">
                                <p class="c-secur">SECURITY ASSURED : <img src="<?= base_url() ?>assets/images/payment-image2.png" alt="payment image" title="secure by"></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="checkout-item">
                        <h4 class="cart1">CART ITEM</h4>
                        <ul>
                            <?php foreach ($cartContents as $index => $item) : ?>
                                <li>
                                    <span><?= $index + 1 ?></span>
                                    <h5><?= esc($item['rep_title']); ?></h5>
                                    <p class="text-muted">Licence : <?= esc($item['license_key']); ?></p>
                                    <strong>$<?= esc($item['license_value']); ?></strong>
                                    <div>
                                        <a href="#" class="rem-item" onclick="event.preventDefault(); document.getElementById('remove-form<?= $index ?>').submit();">
                                            <span class="remove-span"></span> ×
                                        </a>
                                        <form id="remove-form<?= $index ?>" action="<?= base_url('remove-from-ckout') ?>" method="post" style="display: none;">
                                            <input type="hidden" name="index" value="<?= esc($index) ?>">
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="total">
                            <p>Sub Total <span>$<?= number_format($subTotal) ?></span></p>
                            <p>Other Charges <span>$00</span></p>
                            <p>Discount <span>$100</span></p>
                        </div>
                        <div class="g-total">
                            <p>Amount Payable <span>$<?= number_format($subTotal - 100, 2) ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Include footer.php -->
<?php include('footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#checkoutForm').on('submit', function(event) {
            var isValid = true;

            // Validate full name
            var fullName = $('input[name="full_name"]').val();
            if (fullName === '') {
                isValid = false;
                $('#error-full-name').text("Full name is required.");
            } else {
                $('#error-full-name').text("");
            }

            // Validate email
            var email = $('input[name="email"]').val();
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/;
            if (email === '' || !emailPattern.test(email)) {
                isValid = false;
                $('#error-email').text("Please enter a valid email address. Current value: " + email);
            } else {
                $('#error-email').text("");
            }

            // Validate company name
            var companyName = $('input[name="company_name"]').val();
            if (companyName === '') {
                isValid = false;
                $('#error-company-name').text("Company name is required.");
            } else {
                $('#error-company-name').text("");
            }

            // Validate phone number (6 to 15 digits)
            var phone = $('input[name="contact_number"]').val();
            var phonePattern = /^\d{6,15}$/;
            if (phone === '' || !phonePattern.test(phone)) {
                isValid = false;
                $('#error-contact-number').text("Please enter a valid phone number between 6 to 15 digits. Current value: " + phone);
            } else {
                $('#error-contact-number').text("");
            }

            // Validate job role
            var jobRole = $('input[name="job_role"]').val();
            if (jobRole === '') {
                isValid = false;
                $('#error-job-role').text("Job role is required.");
            } else {
                $('#error-job-role').text("");
            }

            // Validate country
            var country = $('select[name="country"]').val();
            if (country === '') {
                isValid = false;
                $('#error-country').text("Please select your country.");
            } else {
                $('#error-country').text("");
            }

            // Validate security code
            var securityCode = $('input[name="security_code"]').val();
            var generatedCode = $('#generatedCode').text().trim();
            if (securityCode === '' || securityCode !== generatedCode) {
                isValid = false;
                $('#error-security-code').text("Security code does not match.");
            } else {
                $('#error-security-code').text("");
            }

            // If any validation fails, prevent form submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>

</body>

</html>
