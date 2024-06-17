<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CATEGORY</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/new.css"> 

    <style>
        .linktag {
            font-size: 17px !important;
            padding: 10px 10px 4px 80px !important;
            background-color: #e3b04b !important;
        }
        .category-container {
            padding-bottom: 21px;
        }
    </style>
</head>
<body>
    <!-- Include header.php -->
    <?php include('header.php'); ?>

    <div class="col-md-12">
        <ol class="breadcrumb linktag">
            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
            <li class="breadcrumb-item">Categories</li>
        </ol>
    </div>

    <div class="container category-container">
        <h3 class="title"><span>Browse Category</span></h3>
        <div class="div1">
            <div class="div2">
                <div class="products-container">
                    <?php foreach ($categories as $category): ?>
                        <div class="product" data-id="<?= $category['sc1_id'] ?>" data-name="p-<?= $category['sc1_id'] ?>">
                            <img src="<?=base_url()?>assets\images\Metallic-Material.jpg" alt="">
                            <h6><?= $category['sc1_name'] ?></h4>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="products-preview">
            <div class="div3">
                <div class="div4">
                    <div class="div44">
                        <?php foreach ($categories as $category): ?>
                            <div class="preview" data-target="p-<?= $category['sc1_id'] ?>">
                                <i class="fas fa-times"></i>
                                <img src="<?=base_url()?>assets\images\Metallic-Material.jpg" alt="">
                                <h6><?= $category['sc1_name'] ?></h4>
                                <div class="stars">
                                    Reports In Category
                                    <span class="random-number"></span>
                                </div>
                                <p><?= $category['sc1_page_title'] ?></p> 
                                <div class="price">$2.00</div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to generate a 4-digit random number
        function generateRandomNumber() {
            return Math.floor(1000 + Math.random() * 9000); // Generates a number between 1000 and 9999
        }

        // Add random numbers to each span with class 'random-number'
        document.querySelectorAll('.random-number').forEach(span => {
            span.textContent = `(${generateRandomNumber()})`;
        });

        let previewContainer = document.querySelector('.products-preview');
        let previewBoxes = previewContainer.querySelectorAll('.preview');

        document.querySelectorAll('.products-container .product').forEach(product => {
            product.onclick = () => {
                previewContainer.style.display = 'flex';
                let name = product.getAttribute('data-name');
                previewBoxes.forEach(preview => {
                    let target = preview.getAttribute('data-target');
                    if (name === target) {
                        preview.classList.add('active');
                    }
                });
            };
        });

        previewBoxes.forEach(close => {
            close.querySelector('.fa-times').onclick = () => {
                close.classList.remove('active');
                previewContainer.style.display = 'none';
            };
        });
    </script>
</body>

<!-- Include the footer -->
<?php include('footer.php'); ?>

</html>
