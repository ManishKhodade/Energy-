<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Reports</title>
    

    <style>
       .linktag{
    font-size: 17px !important;
    padding: 10px 10px 4px 80px !important;
    background-color: #e3b04b !important;
}
    </style>

    <?php include('header.php'); ?>
</head>
<body>
<div class="col-md-12">
	<ol class="breadcrumb linktag">
		<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
		<li class="breadcrumb-item"><a href="#"><?= $category['sc1_name']; ?></a></li>
		
	</ol>
	</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="head-2">
                <h1 class="title"><?= $category['sc1_name']; ?><span> Reports</span></h1>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12" id="report-list">
            <!-- Reports will be loaded here via AJAX -->
        </div>
        <div id="pagination-controls">
            <!-- Pagination links will be generated here via AJAX -->
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    function loadReports(page = 1) {
        $.ajax({
            url: "<?= base_url('get-reports/' . $category['sc1_category_id']); ?>/" + page,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let reportsHtml = '';
                data.reports.forEach(function(report) {
                    reportsHtml += `
                        <div class="col-md-12 report-list latest">
                            <p class="date">${report.rep_date}</p>
                            <img alt="" class="report-cover" src="./cover_image/Speciality-Chemical.jpg" title="report tile">
                            <h4><a href="<?= base_url('report/') ?>${report.rep_id}/${encodeURIComponent(report.rep_url)}">${report.rep_title}</a></h4>
                            <p>Pages: ${report.rep_page} &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Report Code: ${report.rep_id}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                <a href="<?= base_url('report/') ?>${report.rep_id}/${encodeURIComponent(report.rep_url)}"><strong class="read">Read more</strong></a>
                            </p>
                        </div>`;
                });
                $('#report-list').html(reportsHtml);
                $('#report-list').css({
                            'display': 'contents'
                        });

                let paginationHtml = `
                    <div class="col-md-12">
                        <div class="sort-by">
                            <div class="page-no">
                                <strong>Page ${data.currentPage} of ${data.totalPages}</strong>
                            </div>
                            <div class="sort-opt">
                                <ul class="pagination cust-pagination" style="margin: 0; float: left;">`;
                if (data.currentPage > 1) {
                    paginationHtml += `<li><a href="javascript:void(0);" class="page-link" data-page="1">« First</a></li>`;
                }
                // Display only three pages at a time
                let startPage = Math.max(data.currentPage - 1, 1);
                let endPage = Math.min(startPage + 2, data.totalPages);
                for (let i = startPage; i <= endPage; i++) {
                    paginationHtml += `<li class="${i === data.currentPage ? 'active' : ''}"><a href="javascript:void(0);" class="page-link" data-page="${i}">${i}</a></li>`;
                }
                if (data.currentPage < data.totalPages) {
                    paginationHtml += `<li><a href="javascript:void(0);" class="page-link" data-page="${data.totalPages}">Last »</a></li>`;
                }
                paginationHtml += `</ul>
                            </div>
                        </div>
                    </div>`;
                $('#pagination-controls').html(paginationHtml);

                // Update the URL with the current page number
                if (history.pushState) {
                    let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + data.currentPage;
                    window.history.pushState({path: newUrl}, '', newUrl);
                }
            }
        });
    }

    $(document).on('click', '.page-link', function() {
        const page = $(this).data('page');
        loadReports(page);
    });

    // Load the correct page on page load based on the URL
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') ? parseInt(urlParams.get('page')) : 1;
    loadReports(page);
});




</script>
</body>
</html>
