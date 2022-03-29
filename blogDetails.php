<?php 
session_start();
include('includes/config.php');
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
 $_SESSION['token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['submit']))
{
  //Verifying CSRF Token
if (!empty($_POST['csrftoken'])) {
    if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
$name=$_POST['name'];
$email=$_POST['email'];
$comment=$_POST['comment'];
$postid=$_GET['id'];
$stmt = mysqli_query($con,"SELECT * FROM tblposts WHERE PostUrl = '{$_GET['id']}' ");
$productrow = mysqli_fetch_assoc($stmt);
$prodata=$productrow['id'];
// foreach($row as $product){
  // print_r($product);
  echo "<script>console.log('Debug Objects: " . $productrow['id'] . "' );</script>";
// }


$st1='0';
$query=mysqli_query($con,"insert into tblcomments(postId,posturl,name,email,comment,status) values('$prodata','$postid','$name','$email','$comment','$st1')");
if($query):
  echo "<script>alert('comment successfully submit. Comment will be display after admin review ');</script>";
  unset($_SESSION['token']);
else :
 echo "<script>alert('Something went wrong. Please try again.');</script>";  

endif;

}
}
}
$postid=$_GET['id'];

    $sql = "SELECT viewCounter FROM tblposts WHERE Posturl = '$postid'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $visits = $row["viewCounter"];
            $sql = "UPDATE tblposts SET viewCounter = $visits+1 WHERE Posturl ='$postid'";
    $con->query($sql);

        }
    } else {
        echo "no results";
    }
    


?>
<?php
$pid=$_GET['id'];
$currenturl="http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
 $query=mysqli_query($con,"select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblposts.postdes as postdes,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url,tblposts.postedBy,tblposts.authorname,tblposts.authordes,tblposts.cattags,tblposts.hashtags,tblposts.lastUpdatedBy,tblposts.UpdationDate from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.PostUrl='$pid'");
while ($row=mysqli_fetch_array($query)) {
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
    <title><?php echo htmlentities($row['posttitle']);?></title>
    <meta name="description" content="<?php echo htmlentities($row['postdes']);?>" />
    <link rel="canonical" href="https://www.getinfo4free.com/<?php echo htmlentities($row['url']);?>" />
    <meta name="keywords" content="<?php echo htmlentities($row['cattags']);?>" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo htmlentities($row['posttitle']);?>" />
    <meta property="og:description" content="<?php echo htmlentities($row['posttitle']);?>" />
    <meta property="og:url" content="https://www.getinfo4free.com/<?php echo htmlentities($row['url']);?>" />
    <meta property="og:site_name" content="getinfo4free" />
    <meta property="article:published_time" content="<?php echo htmlentities($row['postingdate']);?>" />
    <meta property="article:modified_time" content="<?php echo htmlentities($row['UpdationDate']);?>" />
    <meta property="og:image" content="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" />
    <meta property="og:image:width" content="1140" />
    <meta property="og:image:height" content="760" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:label1" content="Written by" />
    <meta name="twitter:data1" content="<?php echo htmlentities($row['authorname']);?>" />
    <meta name="twitter:label2" content="Est. reading time" />
    <meta name="twitter:data2" content="5 minutes" />

    <!-- imp -->
    <script type="application/ld+json" class="yoast-schema-graph">
        {
            "@context": "https://schema.org",
            "@graph": [{
                    "@type": "WebSite",
                    "@id": "https://www.getinfo4free.com/<?php echo htmlentities($row['url']);?>",
                    "url": "https://www.getinfo4free.com/<?php echo htmlentities($row['url']);?>",
                    "name": "getinfo4free",
                    "description": "<?php echo htmlentities($row['postdes']);?>",
                    "potentialAction": [{
                        "@type": "SearchAction",
                        "target": {
                            "@type": "EntryPoint",
                            "urlTemplate": "https://www.getinfo4free.com/<?php echo htmlentities($row['url']);?>"
                        },
                        "query-input": "required id=<?php echo htmlentities($row['url']);?>"
                    }],
                    "inLanguage": "en-US"
                },
                {
                    "@type": "ImageObject",
                    "@id": "#primaryimage",
                    "inLanguage": "en-US",
                    "url": "admin/postimages/<?php echo htmlentities($row['PostImage']);?>",
                    "contentUrl": "admin/postimages/<?php echo htmlentities($row['PostImage']);?>",
                    "width": 1140,
                    "height": 760,
                    "caption": "<?php echo htmlentities($row['posttitle']);?>"
                },
                {
                    "@type": "WebPage",
                    "@id": "#webpage",
                    "url": "https://www.getinfo4free.com/<?php echo htmlentities($row['url']);?>",
                    "name": "<?php echo htmlentities($row['posttitle']);?>",
                    "isPartOf": {
                        "@id": "https://www.getinfo4free.com/<?php echo htmlentities($row['url']);?>"
                    },
                    "primaryImageOfPage": {
                        "@id": "#primaryimage"
                    },
                    "datePublished": "<?php echo htmlentities($row['postingdate']);?>",
                    "dateModified": "<?php echo htmlentities($row['UpdationDate']);?>",
                    "author": {
                        "@id": "<?php echo htmlentities($row['authorname']);?>"
                    },
                    "breadcrumb": {
                        "@id": "#breadcrumb"
                    },
                    "inLanguage": "en-US",
                    "potentialAction": [{
                        "@type": "ReadAction",
                        "target": [
                            ""
                        ]
                    }]
                },
                {
                    "@type": "BreadcrumbList",
                    "@id": "#breadcrumb",
                    "itemListElement": [{
                            "@type": "ListItem",
                            "position": 1,
                            "name": "Home",
                            "item": "https://www.getinfo4free.com/"
                        },
                        {
                            "@type": "ListItem",
                            "position": 2,
                            "name": "<?php echo htmlentities($row['posttitle']);?>"
                        }
                    ]
                },

            ]
        }
    </script>
    <!-- / Yoast SEO plugin. -->

    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    <link rel="dns-prefetch" href="//s.w.org" />

    <link rel="stylesheet" href="./css/bootstarp.css" media="all" />
    <link rel="stylesheet" href="./css/style.css" media="all" />

    <meta name="generator" content="php" />
    <link rel="shortlink" href="https://www.getinfo4free.com/<?php echo htmlentities($row['url']);?>" />

    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="<?php echo htmlentities($row['posttitle']);?>" />

    <link rel="icon" href="./images/getinfo4free.png" sizes="32x32" />
    <link rel="icon" href="./images/getinfo4free.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="./images/getinfo4free.png" />
    <meta name="msapplication-TileImage" content="./images/getinfo4free.png" />
</head>
<?php } ?>

<body class="post-template-default single single-post postid-1276 single-format-video custom-background wp-custom-logo full-width font-family">
    <!--Skippy-->
    <a id="skippy" class="visually-hidden-focusable" href="#content">
        <div class="container">
            <span class="skiplink-text">Skip to content</span>
        </div>
    </a>

    <div class="bg-image"></div>

    <!-- ========== WRAPPER ========== -->
    <div class="wrapper">
        <!--Header start-->
        <?php include("./includes/header.php");?>

        <!-- main menu -->
        <?php include("./includes/navbar.php");?>
        <?php
$pid=$_GET['id'];
$currenturl="http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
 $query=mysqli_query($con,"select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblposts.postdes as postdes,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url,tblposts.postedBy,tblposts.authorname,tblposts.authordes,tblposts.cattags,tblposts.hashtags,tblposts.lastUpdatedBy,tblposts.UpdationDate from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.PostUrl='$pid'");
while ($row=mysqli_fetch_array($query)) {
?>
        <main id="content">
            <div class="container">
                <div class="row">
                    <!--breadcrumb-->
                    <div class="col-12">
                        <div class="breadcrumb u-breadcrumb pt-3 px-0 mb-0 bg-transparent small">
                            <a class="breadcrumb-item" href="index.php">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="" rel="category tag"><?php echo htmlentities($row['category']);?></a>
                            /
                            <a href="#" rel="category tag"><?php echo htmlentities($row['subcategory']);?></a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<span class="d-none d-md-inline"><?php echo htmlentities($row['posttitle']);?></span>
                        </div>
                    </div>

                    <!--Main content-->
                    <div class="col-md-8">
                        <article class="post-1276 post type-post status-publish format-video has-post-thumbnail hentry category-fashion category-video tag-1990-style tag-summer-style post_format-post-format-video" id="post-1276">
                            <header class="entry-header post-title">
                                <h1 class="entry-title display-4 display-2-lg mt-2">
                                    <?php echo htmlentities($row['posttitle']);?>
                                </h1>
                                <div class="entry-meta post-atribute mb-3 small fw-normal text-muted">
                                    <span class="byline me-2 me-md-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-person me-1" viewBox="0 0 16 16">
                                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                        </svg>
                                        by<span class="author vcard"><a class="url fn n fw-bold" href="#">
                                                <?php echo htmlentities($row['authorname']);?></a></span></span><span class="posted-on me-2 me-md-3">
                                        <span title="Posted on"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg></span>
                                        <time class="entry-date published" datetime="2019-06-16T13:01:29+00:00"><?php echo htmlentities($row['postingdate']);?> </time>
                                        <?php if($row['lastUpdatedBy']!=''):?>
                                        <time class="updated d-none d-md-inline-block" datetime="<?php echo htmlentities($row['UpdationDate']);?>">
                                            ( <?php echo htmlentities($row['UpdationDate']);?> )
                                        </time>

                                        <?php endif;?>
                                    </span>
                                    <span class="me-2 me-md-3 text-muted d-none d-md-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat-left-dots me-1" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z">
                                            </path>
                                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z">
                                            </path>
                                        </svg>
                                        <?php
                  $postid=$_GET['id'];
                  $stmt = mysqli_query($con,"SELECT * FROM tblposts WHERE PostUrl = '{$_GET['id']}' ");
                  $productrow = mysqli_fetch_assoc($stmt);
                  $prodata=$productrow['id'];
                  $stmt1 = mysqli_query($con,"SELECT * FROM tblcomments WHERE postId = '$prodata' ");
                  $count = mysqli_num_rows($stmt1);
                    echo "($count) Comments";
                    ?>
                                    </span><!-- comments -->

                                    <span class="me-2 me-md-3 text-muted d-md-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat-left-dots me-1" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z">
                                            </path>
                                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z">
                                            </path>
                                        </svg>
                                        0 </span><!-- comments mobile -->

                                    <span class="me-2 me-md-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z">
                                            </path>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z">
                                            </path>
                                        </svg>
                                        Views <?php print $visits; ?> </span>
                                    <!--end view-->
                                </div>
                                <!-- .entry-meta -->

                                <!--social share-->

                                <div class="social-share mb-3">
                                    <!-- share facebook -->
                                    <a class="btn btn-social btn-facebook text-white btn-sm blank-windows" href="https://www.facebook.com/sharer.php?u=" target="_blank" rel="noopener" title="Share to facebook">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                        </svg>
                                        <span class="d-none d-sm-inline">Facebook</span>
                                    </a>
                                    <!-- share twitter -->
                                    <a class="btn btn-social btn-twitter text-white btn-sm blank-windows" href="https://www.twitter.com/share?url=" target="_blank" rel="noopener" title="Share to twitter">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                        </svg>
                                        <span class="d-none d-sm-inline">Twitter</span>
                                    </a>
                                    <!-- share linkedin -->
                                    <a class="btn btn-social btn-linkedin text-white btn-sm blank-windows" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=" target="_blank" rel="noopener" title="Share to Linkedin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" viewBox="0 0 512 512">
                                            <path d="M444.17,32H70.28C49.85,32,32,46.7,32,66.89V441.61C32,461.91,49.85,480,70.28,480H444.06C464.6,480,480,461.79,480,441.61V66.89C480.12,46.7,464.6,32,444.17,32ZM170.87,405.43H106.69V205.88h64.18ZM141,175.54h-.46c-20.54,0-33.84-15.29-33.84-34.43,0-19.49,13.65-34.42,34.65-34.42s33.85,14.82,34.31,34.42C175.65,160.25,162.35,175.54,141,175.54ZM405.43,405.43H341.25V296.32c0-26.14-9.34-44-32.56-44-17.74,0-28.24,12-32.91,23.69-1.75,4.2-2.22,9.92-2.22,15.76V405.43H209.38V205.88h64.18v27.77c9.34-13.3,23.93-32.44,57.88-32.44,42.13,0,74,27.77,74,87.64Z" />
                                        </svg>
                                        <span class="d-none d-sm-inline">Linkedin</span>
                                    </a>
                                    <!-- share to whatsapp -->
                                    <a class="btn btn-success text-white btn-sm d-md-none" href="whatsapp://send?text=Read&nbsp;more&nbsp;in&nbsp;" data-action="share/whatsapp/share" target="_blank" rel="noopener" title="Share to whatsapp">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" viewBox="0 0 512 512">
                                            <path d="M414.73,97.1A222.14,222.14,0,0,0,256.94,32C134,32,33.92,131.58,33.87,254A220.61,220.61,0,0,0,63.65,365L32,480l118.25-30.87a223.63,223.63,0,0,0,106.6,27h.09c122.93,0,223-99.59,223.06-222A220.18,220.18,0,0,0,414.73,97.1ZM256.94,438.66h-.08a185.75,185.75,0,0,1-94.36-25.72l-6.77-4L85.56,427.26l18.73-68.09-4.41-7A183.46,183.46,0,0,1,71.53,254c0-101.73,83.21-184.5,185.48-184.5A185,185,0,0,1,442.34,254.14C442.3,355.88,359.13,438.66,256.94,438.66ZM358.63,300.47c-5.57-2.78-33-16.2-38.08-18.05s-8.83-2.78-12.54,2.78-14.4,18-17.65,21.75-6.5,4.16-12.07,1.38-23.54-8.63-44.83-27.53c-16.57-14.71-27.75-32.87-31-38.42s-.35-8.56,2.44-11.32c2.51-2.49,5.57-6.48,8.36-9.72s3.72-5.56,5.57-9.26.93-6.94-.46-9.71-12.54-30.08-17.18-41.19c-4.53-10.82-9.12-9.35-12.54-9.52-3.25-.16-7-.2-10.69-.2a20.53,20.53,0,0,0-14.86,6.94c-5.11,5.56-19.51,19-19.51,46.28s20,53.68,22.76,57.38,39.3,59.73,95.21,83.76a323.11,323.11,0,0,0,31.78,11.68c13.35,4.22,25.5,3.63,35.1,2.2,10.71-1.59,33-13.42,37.63-26.38s4.64-24.06,3.25-26.37S364.21,303.24,358.63,300.47Z" style="fill-rule: evenodd" />
                                        </svg>
                                        <span class="d-none d-sm-inline">Whatsapp</span>
                                    </a>
                                    <!--Share to pinterest-->
                                    <a class="btn btn-social btn-pinterest text-white btn-sm blank-windows" href="http://pinterest.com/pin/create/button/?url=" target="_blank" rel="noopener" title="Share to Pinterest">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" viewBox="0 0 512 512">
                                            <path d="M256.05,32c-123.7,0-224,100.3-224,224,0,91.7,55.2,170.5,134.1,205.2-.6-15.6-.1-34.4,3.9-51.4,4.3-18.2,28.8-122.1,28.8-122.1s-7.2-14.3-7.2-35.4c0-33.2,19.2-58,43.2-58,20.4,0,30.2,15.3,30.2,33.6,0,20.5-13.1,51.1-19.8,79.5-5.6,23.8,11.9,43.1,35.4,43.1,42.4,0,71-54.5,71-119.1,0-49.1-33.1-85.8-93.2-85.8-67.9,0-110.3,50.7-110.3,107.3,0,19.5,5.8,33.3,14.8,43.9,4.1,4.9,4.7,6.9,3.2,12.5-1.1,4.1-3.5,14-4.6,18-1.5,5.7-6.1,7.7-11.2,5.6-31.3-12.8-45.9-47-45.9-85.6,0-63.6,53.7-139.9,160.1-139.9,85.5,0,141.8,61.9,141.8,128.3,0,87.9-48.9,153.5-120.9,153.5-24.2,0-46.9-13.1-54.7-27.9,0,0-13,51.6-15.8,61.6-4.7,17.3-14,34.5-22.5,48a225.13,225.13,0,0,0,63.5,9.2c123.7,0,224-100.3,224-224S379.75,32,256.05,32Z" />
                                        </svg>
                                        <span class="d-none d-sm-inline">Pinterest</span>
                                    </a>
                                    <!-- share via email -->
                                    <a class="btn btn-social btn-envelope text-white btn-sm" href="mailto:?subject=Your&nbsp;post&nbsp;title&amp;body=Read&nbsp;complete&nbsp;article&nbsp;in&nbsp;here&nbsp;" target="_blank" rel="noopener" title="Share by Email">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                                        </svg>
                                        <span class="d-none d-sm-inline">Email</span>
                                    </a>
                                </div>
                                <!-- social share -->
                            </header>
                            <!-- .entry-header -->

                            <div class="entry-content post-content">
                                <figure class="image-single-wrapper">
                                    <img width="750" height="500" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" class="img-fluid lazy wp-post-image" alt="<?php echo htmlentities($row['posttitle']);?>" loading="lazy" data-src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" srcset="
                        admin/postimages/<?php echo htmlentities($row['PostImage']);?> 1024w,
                       admin/postimages/<?php echo htmlentities($row['PostImage']);?> 300w,
                        admin/postimages/<?php echo htmlentities($row['PostImage']);?> 750w,
                        admin/postimages/<?php echo htmlentities($row['PostImage']);?> 1140w
                      " sizes="(max-width: 750px) 100vw, 750px" />
                                    <figcaption class="bg-themes"></figcaption>
                                </figure>

                                <p>
                                    <span class="dropcaps dropcaps-one"><?php 
$pt=$row['postdes'];
              echo  (substr($pt,0,1));?></span><?php echo htmlentities($row['postdes']);?><br />
                                    <!--StartFragment-->
                                </p>
                                <?php 
$pt=$row['postdetails'];
              echo  (substr($pt,0));?>

                            </div>
                            <!-- .entry-content -->

                            <footer class="entry-footer">
                                <div class="tags-links mb-3">
                                    <span class="fw-bold me-2">Category</span>
                                    <?php

   $ip = $row['cattags']; // some IP address
   $data=$row['hashtags'];
   $iparr = explode (",", $ip); 
   $dataarr=explode (",", $data); 
   ?>
                                    <a href="#" rel="category tag"><?php echo htmlentities($iparr[0]);?></a>
                                    <a href="#" rel="category tag"> <?php echo htmlentities($iparr[1]);?></a>
                                    <a href="#" rel="category tag"> <?php echo htmlentities($iparr[2]);?></a>
                                    <a href="#" rel="category tag"> <?php echo htmlentities($iparr[3]);?></a>
                                    <a href="#" rel="category tag"> <?php echo htmlentities($iparr[4]);?></a>

                                </div>
                                <div class="tags-links tagcloud">
                                    <span class="fw-bold me-2">Tags</span>
                                    <a href="#" rel="tag"><?php echo htmlentities($dataarr[0]);?></a>
                                    <a href="#" rel="tag"><?php echo htmlentities($dataarr[1]);?></a>
                                    <a href="#" rel="tag"><?php echo htmlentities($dataarr[2]);?></a>
                                    <a href="#" rel="tag"><?php echo htmlentities($dataarr[3]);?></a>
                                    <a href="#" rel="tag"><?php echo htmlentities($dataarr[4]);?></a>

                                </div>
                            </footer>
                            <!-- .entry-footer -->
                        </article>
                        <!-- #post-## -->
                        <hr />

                        <!--author-->
                        <div class="media author-box">
                            <div class="media-figure mb-3">
                                <img alt="" src="https://secure.gravatar.com/avatar/3b95894fa6fae8fae505c493aa7d7e98?s=100&#038;d=mm&#038;r=g" srcset="
                      https://secure.gravatar.com/avatar/3b95894fa6fae8fae505c493aa7d7e98?s=200&#038;d=mm&#038;r=g 2x
                    " class="avatar avatar-100 photo" height="100" width="100" loading="lazy" />
                            </div>
                            <div class="ms-sm-3 media-body">
                                <h4 class="mb-2 font-weight-bold"><?php echo htmlentities($row['authorname']);?></h4>

                                <p>
                                    <?php echo htmlentities($row['authordes']);?>
                                </p>
                            </div>
                        </div>
                        <hr />

                        <!-- Previous and next article -->

                        <!--related-->
                        <?php include("supportpage/popular-post.php");?>
                        <!--End Related Posts-->
                        <!--suggestion post-->

                        <!-- Suggestion box -->
                        <div class="suggestion-box bg-themes">
                            <h4 class="text-center">You Must Read</h4>
                            <div id="close-suggestion" class="close-suggestion">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </div>
                            <?php 
                                        if (isset($_GET['pageno'])) {
                                                $pageno = $_GET['pageno'];
                                            } else {
                                                $pageno = 1;
                                            }
                                            $no_of_records_per_page = 1;
                                            $offset = ($pageno-1) * $no_of_records_per_page;


                                            $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                                            $result = mysqli_query($con,$total_pages_sql);
                                            $total_rows = mysqli_fetch_array($result)[0];
                                            $total_pages = ceil($total_rows / $no_of_records_per_page);


                                            $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.postdes as postdes,tblposts.authorname as authorname,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 and tblposts.CategoryId=3 order by RAND() LIMIT $offset, $no_of_records_per_page");
                                            while ($row=mysqli_fetch_array($query)) {
                                            ?>
                            <div class="card card-full u-hover hover-a mb-2">
                                <!--thumbnail-->
                                <div class="ratio_251-141 image-wrapper">
                                    <a href="<?php echo htmlentities($row['url']);?>">
                                        <img width="300" height="200" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" class=" img-fluid lazy wp-post-image" alt="<?php echo htmlentities($row['posttitle']);?>" title="<?php echo htmlentities($row['posttitle']);?>" loading="lazy" data-src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" srcset="
                                                    admin/postimages/<?php echo htmlentities($row['PostImage']);?> 360w,
                                                    admin/postimages/<?php echo htmlentities($row['PostImage']);?> 372w,
                                                    admin/postimages/<?php echo htmlentities($row['PostImage']);?> 251w,
                                                    admin/postimages/<?php echo htmlentities($row['PostImage']);?> 230w,
                                                    admin/postimages/<?php echo htmlentities($row['PostImage']);?> 203w,
                                                    admin/postimages/<?php echo htmlentities($row['PostImage']);?>  165w " sizes="(max-width: 300px) 100vw, 300px" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <!-- title -->
                                    <h3 class="card-title mb-2 h5 h4-md">
                                        <a href="<?php echo htmlentities($row['url']);?>"><?php echo htmlentities($row['posttitle']);?></a>
                                    </h3>
                                    <div class="mb-2 text-muted small">
                                        <!--date-->
                                        <?php echo htmlentities($row['postingdate']);?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <!--Comments-->
                        <div id="comments" class="mb-5">
                            <div id="respond" class="comment-respond">
                                <h3 id="reply-title" class="comment-reply-title">
                                    Leave a Reply
                                    <small><a rel="nofollow" id="cancel-comment-reply-link" href="/default/2019/06/the-1990s-trends-that-keep-coming-back/#respond" style="display: none">Cancel reply</a></small>
                                </h3>
                                <form name="Comment" method="post" class="comment-form" novalidate>
                                    <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
                                    <p class="comment-notes">
                                        <span id="email-notes">Your email address will not be published.</span>
                                        Required fields are marked <span class="required">*</span>
                                    </p>
                                    <div class="form-group comment-form-comment">
                                        <textarea aria-label="comments" class="form-control mb-4" id="comment" placeholder="Comments *" name="comment" cols="45" rows="8" required></textarea>
                                    </div>
                                    <div class="form-group comment-form-author">
                                        <input class="form-control mb-4" aria-label="name" id="author" placeholder="Name*" name="name" type="text" value="" size="30" aria-required="true" required />
                                    </div>
                                    <div class="form-group comment-form-email">
                                        <input class="form-control mb-4" aria-label="email" id="email" placeholder="Email *" name="email" type="email" value="" size="30" aria-required="true" required />
                                    </div>

                                    <div class="form-group form-check comment-form-cookies-consent mb-3">
                                        <input class="form-check-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" />
                                        <label class="form-check-label" for="wp-comment-cookies-consent">Save my name, email and website in
                                            this browser for the
                                            next time I comment</label>
                                    </div>
                                    <p class="form-submit">
                                        <input name="submit" type="submit" id="submit" class="btn btn-primary" value="Post Comment" />

                                    </p>
                                </form>
                            </div>
                            <!-- #respond -->
                        </div>
                    </div>
                    <!-- left sidebar check -->

                    <!-- right sidebar check -->

                    <aside class="col-md-4 widget-area end-sidebar-lg" id="right-sidebar">
                        <div class="sticky">
                            <aside id="bootnews_social-4" class="widget widget_categories widget_categories_custom">
                                <div class="block-title-4">
                                    <h4 class="h5 title-arrow"><span>Social Network</span></h4>
                                </div>
                                <ul class="list-unstyled social-two">
                                    <li class="facebook">
                                        <a class="bg-facebook text-white" rel="noopener" href="https://facebook.com/" target="_blank" title="Facebook">Facebook</a>
                                    </li>

                                    <li class="twitter">
                                        <a class="bg-twitter text-white" rel="noopener" href="https://twitter.com/" target="_blank" title="Twitter">Twitter</a>
                                    </li>

                                    <li class="instagram">
                                        <a class="bg-instagram text-white" rel="noopener" href="https://instagram.com/" target="_blank" title="Instagram">Instagram</a>
                                    </li>

                                    <li class="youtube">
                                        <a class="bg-youtube text-white" rel="noopener" href="https://youtube.com/" target="_blank" title="Youtube">Youtube</a>
                                    </li>

                                    <li class="linkedin">
                                        <a class="bg-linkedin text-white" rel="noopener" href="https://linkedin.com/" target="_blank" title="Linkedin">Linkedin</a>
                                    </li>

                                    <li class="vimeo">
                                        <a class="bg-vimeo text-white" rel="noopener" href="https://vimeo.com/" target="_blank" title="Vimeo">Vimeo</a>
                                    </li>

                                    <li class="pinterest">
                                        <a class="bg-pinterest text-white" rel="noopener" href="https://pinterest.com/" target="_blank" title="Pinterest">Pinterest</a>
                                    </li>

                                    <li class="telegram">
                                        <a class="bg-telegram text-white" rel="noopener" href="https://telegram.com/" target="_blank" title="Telegram">Telegram</a>
                                    </li>
                                </ul>
                                <div class="gap-1"></div>
                                <!-- end social content -->
                            </aside>
                            <aside id="bootnews_latestside-4" class="widget widget_categories widget_categories_custom">
                                <div class="block-title-4">
                                    <h4 class="h5 title-arrow"><span>Latest Post</span></h4>
                                </div>
                                <!--post big start-->
                                <div class="big-post">

                                    <?php 
                                                    if (isset($_GET['pageno'])) {
                                                            $pageno = $_GET['pageno'];
                                                        } else {
                                                            $pageno = 1;
                                                        }
                                                        $no_of_records_per_page = 1;
                                                        $offset = ($pageno-1) * $no_of_records_per_page;


                                                        $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                                                        $result = mysqli_query($con,$total_pages_sql);
                                                        $total_rows = mysqli_fetch_array($result)[0];
                                                        $total_pages = ceil($total_rows / $no_of_records_per_page);


                                                $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.postdes as postdes,tblposts.authorname as authorname,tblposts.viewCounter,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by RAND() LIMIT $offset, $no_of_records_per_page");
                                                while ($row=mysqli_fetch_array($query)) {
                                                ?>

                                    <article class="card card-full hover-a mb-4">
                                        <!--thumbnail-->
                                        <div class="ratio_360-202 image-wrapper">
                                            <a href="<?php echo htmlentities($row['url']);?>">
                                                <img width="360" height="202" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" class=" img-fluid lazy wp-post-image" alt="<?php echo htmlentities($row['posttitle']);?>" title="<?php echo htmlentities($row['posttitle']);?>" loading="lazy" data-src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" srcset="
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 360w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 372w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 251w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 230w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 203w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?>  165w " sizes="(max-width: 360px) 100vw, 360px" />
                                                <!-- post type -->
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <!--title-->
                                            <h2 class="card-title h3-sm h1-md h3-lg">
                                                <a href="<?php echo htmlentities($row['url']);?>">
                                                    <?php echo htmlentities($row['posttitle']);?></a>
                                            </h2>
                                            <div class="card-text mb-2 text-muted small">
                                                <!--author-->
                                                <span class="fw-bold d-none d-sm-inline me-1">
                                                    <a href="#" title="Posts by <?php echo htmlentities($row['authorname']);?>" rel="author"><?php echo htmlentities($row['authorname']);?></a>
                                                </span>
                                                <!--date-->
                                                <time class="news-date" datetime="<?php echo htmlentities($row['postingdate']);?>">
                                                    <?php echo htmlentities($row['postingdate']);?></time>
                                                <!--comments-->
                                                <span title="<?php echo htmlentities($row['viewCounter']);?> View" class="float-end">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z">
                                                        </path>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z">
                                                        </path>
                                                    </svg>
                                                    <?php echo htmlentities($row['viewCounter']);?>
                                                </span>
                                            </div>
                                            <!--description-->
                                            <p class="card-text">
                                                <?php echo htmlentities($row['postdes']);?>
                                            </p>
                                        </div>
                                    </article>
                                    <?php } ?>

                                </div>

                                <!--post small start-->
                                <div class="small-post">
                                    <!--post list-->
                                    <?php 
                                            if (isset($_GET['pageno'])) {
                                                    $pageno = $_GET['pageno'];
                                                } else {
                                                    $pageno = 1;
                                                }
                                                $no_of_records_per_page = 3;
                                                $offset = ($pageno-1) * $no_of_records_per_page;


                                                $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                                                $result = mysqli_query($con,$total_pages_sql);
                                                $total_rows = mysqli_fetch_array($result)[0];
                                                $total_pages = ceil($total_rows / $no_of_records_per_page);


                                        $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.postdes as postdes,tblposts.authorname as authorname,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1  order by RAND() LIMIT $offset, $no_of_records_per_page");
                                        while ($row=mysqli_fetch_array($query)) {
                                        ?>

                                    <article class="card card-full hover-a mb-4">
                                        <div class="row">
                                            <!--thumbnail-->
                                            <div class="col-3 col-md-4 pe-2 pe-md-0">
                                                <div class="ratio_115-80 image-wrapper">
                                                    <img width="115" height="80" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" class=" img-fluid lazy wp-post-image" alt="<?php echo htmlentities($row['posttitle']);?>" title="<?php echo htmlentities($row['posttitle']);?>" loading="lazy" data-src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" srcset="
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 360w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 372w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 251w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 230w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?> 203w,
                                                            admin/postimages/<?php echo htmlentities($row['PostImage']);?>  165w " sizes="(max-width: 360px) 100vw, 360px" />
                                                    <!-- post type -->
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-9 col-md-8">
                                                <div class="card-body pt-0">
                                                    <!--title-->
                                                    <h3 class="card-title h6 h4-md h6-lg">
                                                        <a href="<?php echo htmlentities($row['url']);?>">
                                                            <?php echo htmlentities($row['posttitle']);?></a>
                                                    </h3>
                                                    <!--date-->
                                                    <div class="card-text small text-muted">
                                                        <time class="news-date" datetime="<?php echo htmlentities($row['postingdate']);?>">
                                                            <?php echo htmlentities($row['postingdate']);?></time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <?php } ?>
                                </div>
                                <div class="gap-0"></div>
                            </aside>
                            <aside id="bootnews_custompost-5" class="widget widget_categories widget_categories_custom">
                                <div class="block-title-4">
                                    <h4 class="h5 title-arrow"><span>Popular post</span></h4>
                                </div>
                                <!--style 4-->
                                <ul class="post-number list-unstyled border-bottom-last-0 rounded mb-5">
                                    <?php 
                                            if (isset($_GET['pageno'])) {
                                                    $pageno = $_GET['pageno'];
                                                } else {
                                                    $pageno = 1;
                                                }
                                                $no_of_records_per_page = 6;
                                                $offset = ($pageno-1) * $no_of_records_per_page;


                                                $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                                                $result = mysqli_query($con,$total_pages_sql);
                                                $total_rows = mysqli_fetch_array($result)[0];
                                                $total_pages = ceil($total_rows / $no_of_records_per_page);


                                        $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.postdes as postdes,tblposts.authorname as authorname,tblposts.viewCounter as viewcount,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1  order by RAND() LIMIT $offset, $no_of_records_per_page");
                                        while ($row=mysqli_fetch_array($query)) {
                                        ?>
                                    <li class="hover-a">
                                        <a class="h5 h6-md h5-lg" href="<?php echo htmlentities($row['url']);?>"><?php echo htmlentities($row['posttitle']);?></a>
                                    </li>
                                    <?php } ?>

                                </ul>
                            </aside>
                        </div>
                    </aside>
                </div>
            </div>
        </main>
        <?php } ?>
        <!--End main content-->

        <!--Footer start-->

        <?php 
    $stmt = mysqli_query($con,"SELECT * FROM tblposts WHERE PostUrl = '{$_GET['id']}' ");
    $productrow = mysqli_fetch_assoc($stmt);
    $prodata=$productrow['id'];
 $sts=1;
 $query=mysqli_query($con,"select name,comment,postingDate from  tblcomments where postId='$prodata' and status='$sts'");
while ($row=mysqli_fetch_array($query)) {
?>
        <div class="container col-md-12 media mb-4">
            <div class="media-body" style="border: 1px solid #4f46e5;
    padding: 15px;
    border-radius: 10px;
">
                <h5 class="mt-0">Commented By: <?php echo htmlentities($row['name']);?> <br />
                    <span style="font-size:11px;"><b>Commented at</b> <?php echo htmlentities($row['postingDate']);?></span>
                </h5>

                Comment: <?php echo htmlentities($row['comment']);?>
            </div>
        </div>

        <hr />
        <?php } ?>
        <?php include("./includes/footer.php")?>
    </div>
    <!-- ========== END WRAPPER ========== -->

    <!--Back to top-->
    <a class="back-top btn btn-light border position-fixed r-1 b-1" href="#">
        <svg class="bi bi-arrow-up" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd"></path>
            <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L8 3.707 5.354 6.354a.5.5 0 11-.708-.708l3-3z" clip-rule="evenodd"></path>
        </svg>
    </a>


    <script async src="js/bundle.min.js" id="bootnews-scripts-js"></script>
    <script async src="./js/embed.min.js" id="wp-embed-js"></script>

</body>

</html>