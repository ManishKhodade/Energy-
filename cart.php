<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <style>
       .linktag{
    font-size: 17px !important;
    padding: 10px 10px 4px 80px !important;
    background-color: #e3b04b !important;
}
    </style>
    <!-- Include header.php -->
    <?php include('header.php'); ?>
</head>

<body>
<div class="col-md-12">
	<ol class="breadcrumb linktag">
		<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
		<li class="breadcrumb-item"><a href="#">Shopping Cart</a></li>
	</ol>
	</div>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="head-2">
                    <h1 class="title">Shopping<span> Cart</span></h1>
                </div>
            </div>
            <div class="col-md-8">

                <!-- ADD TO CART CODE STARTS HERE -->
                <div class="cart-container">
                    <?php if (!empty($cartContents)) : ?>
                        <?php 
                        $subTotal = 0;
                        foreach ($cartContents as $index => $item) : 
                            $subTotal += (float) $item['license_value'];
                        ?>
                            <div class="row cart-item">

                                <div class="col-md-8">
                                    <img src="https://www.24chemicalresearch.com/assets/images/covers/organic-materials/Organic-material.png" alt="Report Image" itemprop="image">
                                    ReportID: <?= esc($item['report_id']); ?>
                                    <h4><a href="<?= base_url('report/' . esc($item['report_id']) . '/' . urlencode(esc($item['rep_url']))) ?>"><?= esc($item['rep_title']); ?></a></h4>
                                    <p>License: <?= esc($item['license_key']); ?> <strong></strong>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Price:
                                        <strong>$<?= esc($item['license_value']); ?></strong>
                                    </p>
                                    <span></span>
                                </div>

                                <div class="col-md-4 text-center">
                                    <h5>SELECT LICENSE</h5>
                                    <form name="update_license_form" action="<?= base_url('update-cart-license') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="index" value="<?= esc($index) ?>">
                                        <select class="selectClass" id="license" name="license" onchange="this.form.submit()">
                                            <?php foreach ($item['license_types'] as $licenseType) : ?>
                                                <option value="<?= $licenseType['li_key'] . '-' . $licenseType['li_value'] ?>" <?= ($licenseType['li_key'] == $item['license_key']) ? 'selected' : '' ?>>
                                                    $<?= $licenseType['li_value'] ?> - <?= $licenseType['li_key'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </form>
                                </div>

                                <div>
                                    <a href="#" class="rem-item" onclick="event.preventDefault(); document.getElementById('remove-form<?= $index ?>').submit();">
                                        <span>Remove</span> ×
                                    </a>
                                    <form id="remove-form<?= $index ?>" action="<?= base_url('remove-from-cart') ?>" method="post" style="display: none;">
                                        <input type="hidden" name="index" value="<?= esc($index) ?>">
                                        <?= csrf_field() ?>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-md-12 text-center empty-cart">
                            <h2 class="color"><strong>Shopping cart is empty!</strong></h2>
                            <p class="text-muted">You have no items in your shopping cart.<br>
                                Click here <i class="fa fa-hand-o-down text-primary" style="font-size:20px"></i> to continue
                                shopping.</p>
                            <a href="<?= base_url() ?>letest-reports" class="btn-1"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;CONTINUE SHOPPING</a>
                        </div>
                    <?php endif; ?>

                    <div class="row cart-btn">
                        <div class="col-md-6">
                            <a href="<?= base_url()?>letest-reports"><i class="fa fa-chevron-circle-left"></i>&nbsp;&nbsp;CONTINUE SHOPPING</a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= base_url('checkout/' . session()->get('user_id')) ?>" class="checkout">
                                PROCEED TO CHECKOUT&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <?php if (!empty($cartContents)) : ?>
                    <div class="row">
                        <div class="checkout-item">
                            <h4 class="p-color">CART ITEM</h4>
                            <div class="total">
                                <p>Sub Total <span>$<?= number_format($subTotal, 2) ?></span></p>
                                <p>Other Charges <span>$00</span></p>
                                <p>Discount <span>$00</span></p>
                            </div>
                            <div class="g-total">
                                <p>Amount Payable <span>$<?= number_format($subTotal, 2) ?></span></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- ADD TO CART CODE ENDS HERE -->
        </div>
    </div>

    <!-- Include footer.php -->
    <?php include('footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
