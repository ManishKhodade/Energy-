<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $content['page_title'] ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        
        <style>
       .linktag{
    font-size: 17px !important;
    padding: 10px 10px 4px 80px !important;
    background-color: #e3b04b !important;
}


.counter-wrapper{
    background: url(./assets/images/success.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-column-gap: 1.5rem;
    padding: 10rem 9%;
    margin-top: 5rem;
    position: relative;
}
.counter-wrapper::before{
    position: absolute;
    content: '';
    content: 0;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    z-index: 1;
}
.counter{
   text-align: center;   
   color: #ddd;
   z-index: 2;
   position: relative;
}
.counter::before{
    position: absolute;
    content: '';
    bottom: -2rem;
    left: 50%;
    width: 20%;
    height: .2rem;
    background: #4DB7FE;
    border-radius: .5rem;
    -webkit-border-radius: .5rem;
    -moz-border-radius: .5rem;
    -ms-border-radius: .5rem;
    -o-border-radius: .5rem;
    transform: translateX(-50%);
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
}
.counter .count{
    font-size: 5rem;
    margin-bottom: 1rem;    
}
.counter p{
    font-size: 1.4rem;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
}







@media (max-width: 991px) {
    html{
        font-size: 55%;
    }
}
@media (max-width: 768px) {
   .counter-wrapper{
       grid-template-columns: repeat(2, 1fr);
       grid-row-gap: 8rem;
   }
}
@media (max-width: 450px) {
    html{
        font-size: 50%;
    }
    .counter-wrapper{
        grid-template-columns: 1fr;
    }
}




    </style>
 
</head>


<!-- Include header.php -->
<?php include('header.php'); ?>


<body>
    <div class="col-md-12">
	<ol class="breadcrumb linktag">
		<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
		<li class="breadcrumb-item">About Us</li>
	
	</ol>
	</div>
   
    <div class="counter-wrapper">
            <div class="counter">
                <h1 class="count" data-target="1254">0</h1>
                <p>New Visiters Every Week</p>
            </div>
            <div class="counter">
                <h1 class="count" data-target="12168">0</h1>
                <p>Happy customers every year</p>
            </div>
            <div class="counter">
                <h1 class="count" data-target="2172">0</h1>
                <p>Won Amazing Awards</p>
            </div>
            <div class="counter">
                <h1 class="count" data-target="732">0</h1>
                <p>New Listing Every Week</p>
            </div>
        </div>

    <section id="about-section">



    
        <div class="about-left">
            <img src="<?=base_url()?>./assets/images/business-2863432_640.webp" alt="About Img" />
        </div>

      
        <div class="about-right">
            <h1>About Us</h1>
            <div class="container aboutpara">
                <p><?= $content['cms_content'] ?></p>
            </div>
        </div>
    </section>

    <div class="mvv-container">
        <div class="mvv-block">
            <div class="image">
                <img src="<?=base_url()?>./assets/images/mission.jpg" alt="">
            </div>
            <div class="content">
                <h5>
                    Our Mission
                </h5>
                <li> Our prime focus is on providing bespoke industry intelligence, equity research reports, and business
                    consulting services in the chemical sector across the globe. We work with an agenda of providing
                    excellent user experience to the buyers as well as the sellers. </li>
                <li>Our research team works passionately to make sure that every client experiences the result-oriented
                    content. 24chemicalresearch is a platform where both the parties, i.e. sellers and buyers get equal
                    opportunity to research about the required product (in case of the buyer) and to showcase their
                    product (in case of a seller). </li>
                <li>
                    Thus, 24chemicalresearch provides opportunities to both the parties in knowing useful insights about
                    the current market scenarios and needs. Our wide range of client base has helped us in attaining a
                    huge collection of market research report samples in the chemical research domain.
                </li>
            </div>
        </div>


        <div class="mvv-block visionBlock">
            <div class="image">
                <img src="<?=base_url()?>./assets/images/vision.jpg" alt="">
            </div>
            <div class="content">
                <h5>
                    Our Vision
                </h5>
                <ul>
                    <li>Our utter focus is only on the Chemical Industry market with a specialized research team.</li>
                    <li>Our portal acts as a one-stop guide in providing results to all your chemical industry-related
                        queries and thus provide you with complete information related to your search.</li>
                    <li>Our dedicated team of experts, authors and analysts make sure that the content produced is up to
                        the mark and error-free.</li>
                    <li>We have a huge collection of Chemical Industry-related research samples that can be accessed on
                        our portal easily.</li>
            </div>
        </div>

        <div class="mvv-block">
            <div class="image">
                <img src="<?=base_url()?>./assets/images/value.jpg" alt="">
            </div>
            <div class="content">
                <h5>
                    Our Value
                </h5>
                <ul>
                    <li>We follow appropriate research methodologies to obtain impeccable results. </li>
                    <li>We offer competitive prices for all the products we sell through our portal. </li>
                    <li>Various strategies of the competitor can be known through our research reports like pricing
                        strategy, advertising strategy, brand awareness strategy and many more. </li>
                    <li>One can easily meet his/her clients for their chemical-related products by registering their
                        company profile on our portal.</li>
                    <li>We use a proven research methodology to produce quality research information.</li>
                    <li>We do provide customized reports within a stipulated time frame to achieve client deadlines.
                    </li>
                    <li>Client transactions and the monetary information will be confidential and secured for a smooth
                        end-to-end experience.</li>
                </ul>
            </div>
        </div>






    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script>

const counts = document.querySelectorAll('.count')
const speed = 97

counts.forEach((counter) => {
    function upDate(){
        const target = Number(counter.getAttribute('data-target'))
        const count = Number(counter.innerText)
        const inc = target / speed        
        if(count < target){
            counter.innerText = Math.floor(inc + count) 
            setTimeout(upDate, 15)
        }else{
            counter.innerText = target
        }
    }
    upDate()
})
    </script>

    
<!-- Include the footer -->
<?php include('footer.php'); ?>


</body>

</html>