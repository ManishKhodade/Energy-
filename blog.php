<?php
// Get the current page from URL parameters, default to 1 if not set
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="language" content="EN">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title> BLOG</title>
    





    <style>
        a {
            text-decoration: none;
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
    <!-- BLOG START HERE -->
    <div class="col-md-12">
	<ol class="breadcrumb linktag">
		<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
		<li class="breadcrumb-item">Blog</li>
	</ol>
	</div>
    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="head-2">

                    <h1 class="title">Blog</h1>

                </div>

            </div>



            <div class="clearfix"></div>



            <div class="col-md-12">

                <div class="row">



                    <div class="col-md-8">


                        <!-- report list start -->
                        <div id="NewsList">
                        </div>
                        <!-- report list end -->

                        <div id="pagination"></div>



                    </div>

                    <div class="col-md-4 news-rreport">

                        <h2>Latest Reports</h2>


                        <ul>
                            <?php foreach ($reports as $report) : ?>
                                <li>
                                    <a href="<?= base_url('report/' . $report['rep_id'] . '/' . urlencode($report['rep_url'])) ?>">
                                        <span class="date"><?= date('F j, Y', strtotime($report['rep_date'])) ?></span>
                                        <span class="title"><?= esc($report['rep_title']) ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>



                </div>
            </div>

            <!-- BLOG END HERE -->

        </div>
    </div>



</body>

<script>
    $(document).ready(function() {
        // Initial page load
        loadNews(<?php echo $page; ?>);

        // Function to load news via AJAX
        function loadNews(page) {
            $.ajax({
                url: '<?= base_url('blog/page') ?>/' + page,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Append loaded news to the existing list
                    $('#NewsList').empty();
                    $.each(response.news, function(index, article) {
    // Split the content into sentences
    var sentences = article.nws_content.split(/[\.\?!]/);
    // Extract the first sentence
    var firstSentence = sentences[0];
    // Trim any leading or trailing whitespace
    firstSentence = firstSentence.trim();
    var listItem = `
        <div class="news-list">
            <div class="text-muted"><i class="fa fa-calendar-o"></i>${article.nws_date}</div>
            <h5 class="title"><a href="<?= base_url('blog/') ?>${article.id}/${encodeURIComponent(article.nws_url)}">${article.nws_title}</a></h5>
            <p>${firstSentence}</p>
            <span xss="removed">Anthracite Market Demand</span>
            <p>The dem...</p>
        </div>`;
    // Append the generated article HTML to the reportList div
    $('#NewsList').append(listItem);
});



                    $('#NewsList').css({
                        'display': 'contents'
                    });

                    // Generate pagination
                    generatePagination(page, response.totalNews, response.perPage);
                }
            });
        }

        // Function to generate pagination
        function generatePagination(currentPage, totalPages) {
            $('#pagination').empty();

            // Update the page number in the page-no div
            $('.page-no strong').text('Page ' + currentPage + ' of ' + totalPages);

            // Create the pagination HTML structure
            var paginationHTML = '<div class="col-md-12"><div class="sort-by"><div class="page-no"><strong>Page ' + currentPage + ' of ' + totalPages + '</strong></div><div class="sort-opt"><ul class="pagination cust-pagination" style="margin: 0;float:left;">';

            // Previous page link
            if (currentPage > 1) {
                paginationHTML += '<li><a class="pageClass" href="#" data-page="' + (currentPage - 1) + '">Previous</a></li>';
            }

            // First page link
            paginationHTML += '<li><a class="pageClass" href="#" data-page="1">First</a></li>';

            // Pages between first and last
            var startPage = currentPage - 1;
            var endPage = currentPage + 2;
            if (startPage < 1) {
                startPage = 1;
                endPage = 4;
            }
            if (endPage > totalPages) {
                endPage = totalPages;
            }
            for (var i = startPage; i <= endPage; i++) {
                if (i === currentPage) {
                    paginationHTML += '<li class="active"><a href="#" data-page="' + i + '">' + i + '</a></li>';
                } else {
                    paginationHTML += '<li><a class="pageClass" href="#" data-page="' + i + '">' + i + '</a></li>';
                }
            }

            // Last page link
            paginationHTML += '<li><a class="pageClass" href="#" data-page="' + totalPages + '">Last</a></li>';



            paginationHTML += '</ul></div></div></div>';

            // Append the pagination HTML to the pagination container
            $('#pagination').append(paginationHTML);

           // Pagination link click event
$('#pagination').on('click', 'a.pageClass', function(e) {
    e.preventDefault();
    var page = $(this).data('page');
    loadNews(page);
    
    // Update URL without reloading the page
    updateURL(page);
});

// Function to update URL with page parameter
function updateURL(page) {
    var newURL = window.location.href.split('?')[0]; // Get current URL without query parameters
    newURL += '?page=' + page; // Add page parameter to URL
    window.history.pushState({ path: newURL }, '', newURL); // Update URL without reloading the page
}
        }



    });
</script>

<!-- PROBLEME IN NUMBER SPACING AND RESPONSIVNESS in IPAD -->
<!-- Include the footer -->
<?php include('footer.php'); ?>