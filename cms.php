<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="language" content="EN">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title><?= esc($cmsContent['page_title']) ?></title>
    

       
<!-- Include header.php -->
<?php include('header.php'); ?>
<style>
       .linktag{
    font-size: 17px !important;
    padding: 10px 10px 4px 80px !important;
    background-color: #e3b04b !important;
}
    </style>

</head>

<body>
   
<div class="col-md-12">
	<ol class="breadcrumb linktag">
		<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
		<li class="breadcrumb-item active"><?= esc($cmsContent['cms_title']) ?></li>
	</ol>
	</div>


    <!-- ABOUT US SECTION START HERE -->

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="head-2">
                    <h1 class="title"><?= esc($cmsContent['cms_title']) ?></span></h1>
                </div>
                <p style="font-size: 15px;line-height: 24px;">
                <?= $cmsContent['cms_content'] ?>
            </p>

            </div>
            <div class="col-lg-4 col-md-12">
                <div class="key-point">
                    <h5>OUR KEY POINTS</h5>
                    <ul class="key-list">
                        <li>
                            <i class="fa fa-search-plus"></i>
                            <h4>Comprehensive Research</h4>
                            <p>Offers Penetrative insights &amp; holistic understanding of the market</p>
                        </li>
                        <li>
                            <i class="fa fa-database"></i>
                            <h4>Data Accuracy &amp; Reliability</h4>
                            <p>Strictly follows the Research Methodology for flawless results</p>
                        </li>
                        <li> <i class="fa fa-money"></i>
                            <h4>Competitive Pricing</h4>
                            <p>Ensure the best and affordable pricing</p>
                        </li>
                        <li>
                            <i class="fa fa-shield"></i>
                            <h4>Security &amp; Confidentiality</h4>
                            <p>All your transactions are secured end-to-end, ensuring a satisfactory purchase</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>  

   <!-- ABOUT US SECTION END HERE -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

 
           
<!-- Include the footer -->
<?php include('footer.php'); ?>


</body>






