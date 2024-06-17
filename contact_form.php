<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- contact Css Start -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/contactCss.css">
    <!-- contact Css End -->

    <!-- Include header.php -->
    <?php include('header.php'); ?>

    <style>
        .textarea {
            margin-top: -19px;
        }

        .new-container-input label {
            position: relative;
            top: -27px;
        }

        .input-container1.focus label {
            top: 0;
            transform: translateY(-50%);
            left: 25px;
            font-size: 0.8rem;
        }

        .input-container1.focus span:before,
        .input-container1.focus span:after {
            width: 50%;
            opacity: 1;
        }

        .input-container1 span {
            position: absolute;
            top: 0;
            left: 25px;
            transform: translateY(-50%);
            font-size: 0.8rem;
            padding: 0 0.4rem;
            color: transparent;
            pointer-events: none;
            z-index: 500;
        }

        .input-container1 span:before,
        .input-container1 span:after {
            content: "";
            position: absolute;
            width: 10%;
            opacity: 0;
            transition: 0.3s;
            height: 5px;
            background-color: #1abc9c;
            top: 100%;
            transform: translateY(-50%);
            left: -350%;
        }

        .input-container1 {
            position: relative;
            margin: 1rem 0;
        }

        .input-container1 label {
            position: absolute;
            top: 26%;
            left: 15px;
            transform: translateY(-50%);
            padding: 0 0.4rem;
            color: #fafafa;
            font-size: 0.9rem;
            font-weight: 400;
            pointer-events: none;
            z-index: 1000;
            transition: 0.5s;
        }

        .linktag {
            font-size: 17px !important;
            padding: 10px 10px 4px 80px !important;
            background-color: #e3b04b !important;
        }

        .new-btn {
            padding: 0.6rem 1.3rem;
            background-color: #fff;
            border: 2px solid #fafafa;
            font-size: 0.95rem;
            color: #1abc9c;
            line-height: 1;
            border-radius: 25px;
            outline: none;
            cursor: pointer;
            transition: 0.3s;
            margin: 0;
        }

        .new-btn:hover {
            background-color: transparent;
            color: #fff;
        }

        .code-security {
            border-radius: 14px;
            width: 20%;
            background-color: lightgrey;
            padding: 3px 10px 5px 6px;
            height: 1%;
            left: 77%;
            top: -57px;
            position: relative;
            justify-content: end;
            display: flex;
            font-size: 18px;
            font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif;
            font-weight: 500;
            color: black;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <div class="col-md-12">
        <ol class="breadcrumb linktag">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Contact Us</a></li>
        </ol>
    </div>

    <div class="contactusContainer">
        <span class="big-circle"></span>
        <img src="<?= base_url() ?>img/shape.png" class="square" alt="" />
        <div class="form">
            <div class="contact-info">
                <h3 class="title">Let's get in touch</h3>

                <div class="info">
                    <div class="information">
                        <p>203A, City Vista, Fountain Road, Kharadi, Pune, India - 411014.</p>
                    </div>
                    <div class="information">
                        <p>help@24chemicalresearch.com</p>
                    </div>
                    <div class="information">
                        <p>+91 9169162030 (Asia)</p>
                    </div>
                </div>

                <div class="social-media">
                    <p>Connect with us :</p>
                    <div class="social-icons">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="col mapcol">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.7653674817166!2d73.892852214369!3d18.53950217343485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c1087eb86595%3A0x59473795a4ee4980!2sN+Main+Rd%2C+Koregaon+Park%2C+Pune%2C+Maharashtra!5e0!3m2!1sen!2sin!4v1540290270805" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                </div>
            </div>

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                <form class="formClass" id="contactForm" action="<?= base_url('contact/store') ?>" method="post" autocomplete="off">
                    <h3 class="title">Contact us</h3>
                    <div class="error-message" id="errorMessage"></div>
                    <div class="input-container">
                        <input type="text" name="name" class="input" required />
                        <label for="">Username</label>
                        <span>Username</span>
                    </div>
                    <div class="input-container">
                        <input type="email" name="email" class="input" required />
                        <label for="">Email</label>
                        <span>Email</span>
                    </div>
                    <div class="input-container">
                        <input type="tel" name="phone" class="input" required minlength="6" maxlength="15" />
                        <label for="">Phone</label>
                        <span>Phone</span>
                    </div>
                    <div class="input-container">
                        <input type="text" name="Company_name" class="input" required />
                        <label for=""> Enter Company name</label>
                        <span>Company</span>
                    </div>
                    <div class="input-container">
                        <select name="Country" class="input" required>
                            <option value="">Select Country</option>
                            <?php foreach ($countries as $country) : ?>
                                <option value="<?= esc($country['name']) ?><?= esc($country['phonecode']) ?>"><?= esc($country['name']) ?> (+<?= esc($country['phonecode']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-container">
                        <input type="text" name="security_code" class="input" required />
                        <label for=""> Enter security code</label>
                        <span>security</span>
                    </div>
                    <div class="code-security">
                        <span id="securityCode"><?= $securityCode ?></span>
                    </div>
                    <div class="input-container textarea">
                        <textarea name="message" class="input" required></textarea>
                        <label for="">Message</label>
                        <span>Message</span>
                    </div>
                    <input type="submit" value="Send" class="btn11 new-btn" />
                </form>
            </div>
        </div>
    </div>

    <div id="footer"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <script>
        const inputs = document.querySelectorAll(".input");

        function focusFunc() {
            let parent = this.parentNode;
            parent.classList.add("focus");
        }

        function blurFunc() {
            let parent = this.parentNode;
            if (this.value == "") {
                parent.classList.remove("focus");
            }
        }

        inputs.forEach((input) => {
            input.addEventListener("focus", focusFunc);
            input.addEventListener("blur", blurFunc);
        });

        document.getElementById("contactForm").addEventListener("submit", function(event) {
            let errorMessage = "";

            // Check if security code matches
            const enteredCode = document.querySelector('input[name="security_code"]').value;
            const actualCode = document.getElementById("securityCode").innerText;
            if (enteredCode !== actualCode) {
                errorMessage = "Security code does not match.";
            }

            // Validate phone number length (6 to 15 digits)
            const phoneInput = document.querySelector('input[name="phone"]');
            if (phoneInput.value.length < 6 || phoneInput.value.length > 15) {
                errorMessage = "Phone number must be between 6 to 15 digits.";
            }

            // Validate phone number format (basic check for digits only)
            const phoneRegex = /^[0-9]+$/;
            if (!phoneRegex.test(phoneInput.value)) {
                errorMessage = "Phone number can only contain digits.";
            }

            // Validate email
            const emailInput = document.querySelector('input[name="email"]');
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (emailInput.value === '' || !emailPattern.test(emailInput.value)) {
                errorMessage = "Please enter a valid email address.";
            }

            if (errorMessage) {
                event.preventDefault();
                document.getElementById("errorMessage").innerText = errorMessage;
            }
        });
    </script>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>

</body>

</html>
