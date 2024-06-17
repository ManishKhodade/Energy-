<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="language" content="EN">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>MARKET INSIGHTS</title>
    
    <link href="<?=base_url()?>/assets/images/favicon24cr.png" type="image/x-icon">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
  
    <link rel="stylesheet" href="<?=base_url()?>assets/client-images/">
    
 
   
    <style>
        a {
            text-decoration: none;
        }
        .news-sbtn a{
            background-color: #e3b04b !important;
            color: black !important;
        }
        .color{
            color:black !important;
            border:none !important;
        }
       
       .linktag{
    font-size: 17px !important;
    padding: 10px 10px 4px 80px !important;
    background-color: #e3b04b !important;
}
    
    </style>
</head>

<body>
  
<!-- Include header.php -->
<?php include('header.php'); ?>

<div class="col-md-12">
	<ol class="breadcrumb linktag">
		<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
		<li class="breadcrumb-item"><a href="<?=base_url()?>blog">Blog</a></li>
		<li class="breadcrumb-item active"><?php echo $article['nws_title']; ?></li>
	</ol>
	</div>




    <!-- BLOG ANTHRACITE MARKET INSIGHTS STARTS HERE  -->
    <div class="container">
        <div class="row">
            <div class="col-md-8  news-blog" itemscope="" itemtype="http://schema.org/Article">
                <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
                    itemid="https://www.24marketreports.com/article">
                <div class="news-title">
                    <time class="text-muted"><i class="fa fa-calendar-o"></i> <?php echo $article['nws_date']; ?></time>
                    <h1 itemprop="headline"><?php echo $article['nws_title']; ?></h1>
                </div>
                <?php echo $article['nws_content']; ?>
            </div>
            <div class="col-md-4">
                <div class="news-sample">
                    <p>Get more information on this market</p>
                    <img src="https://www.24chemicalresearch.com/assets/images/12.jpg" alt="report title">
                    <h4>Anthracite Market Global Outlook and Forecast 2023-2029</h4>
                    <div class="news-sbtn">
                        <a
                            href="#">Download
                            Free Sample <i class="fa fa-download"></i></a>
                        <a class="color"
                            href="#">View
                            Full Report <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Include the footer -->
<?php include('footer.php'); ?>



   
</body>


