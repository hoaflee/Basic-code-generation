<?php
/* @var $this yii\web\View */
$this->title = 'CoGe - BigData code generator';
?>
<div class="header-section">

 <script>
    // You can also use "$(window).load(function() {"
    $(function () {
      // Slideshow 4
      $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });
    }
    );
  </script>

    <div  id="top" class="callbacks_container">
      <ul class="rslides" id="slider4">
        <li>
          <img src="images/slide.jpg" alt="">
          <div class="caption text-center">
                <div class="slide-text-info">
                        <h1>Introducing <span>Mapreduce.</span></h1>
                        <h2>Made to modify and use anywhere</h2>
                        <div class="slide-text">
                                <ul>
                                        <li><span> </span>Writing a map function </li>
                                        <li><span> </span>Writing a reduce function </li>
                                        <li><span> </span>Combine and edit final code generated</li>
                                </ul>
                        </div>
                        <div class="clearfix"> </div>
                        <div class="big-btns">
                                <a class="download" href="index.php?r=user">MapReduce code generator</a>
                        </div>
                </div>
          </div>
        </li>
       <!--  <li>
          <img src="images/slide.jpg" alt="">
          <div class="caption text-center">
                <div class="slide-text-info">
                        <h1>Introducing <span>Pig</span></h1>
                        <h2>Made to modify and use anywhere</h2>
                        <div class="slide-text">
                                <ul>
                                        <li><span> </span>High-level platform for creating MapReduce programs used with Hadoop</li>
                                        <li><span> </span>Excels at describing...</li>
                                        <li><span> </span>The language for this platform is called Pig Latin </li>                                        
                                </ul>
                        </div>
                        <div class="clearfix"> </div>
                        <div class="big-btns">
                                <a class="download" href="index.php?r=user/intro&model=pig">Pig code generator</a>			          			
                        </div>
                </div>
          </div>
        </li>
        <li>
          <img src="images/slide.jpg" alt="">
          <div class="caption text-center">
                <div class="slide-text-info">
                        <h1>Introducing <span>Hive</span></h1>
                        <h2>Made to modify and use anywhere</h2>
                        <div class="slide-text">
                                <ul>
                                        <li><span> </span>Is a data warehousing infrastructure for Hadoop</li>
                                        <li><span> </span>The primary responsibility is to provide data summarization, query and analysis</li>
                                        <li><span> </span>It supports analysis of large datasets stored in Hadoop’s HDFS as well as on the Amazon S3 filesystem</li>
                                </ul>
                        </div>
                        <div class="clearfix"> </div>
                        <div class="big-btns">
                                <a class="download" href="index.php?r=user/intro&model=hive">Hive code generator</a>
                        </div>
                </div>
          </div>
        </li>
        <li>
          <img src="images/slide.jpg" alt="">
           <div class="caption text-center">
           <div class="slide-text-info">
                        <h1>Introducing <span>Hbase</span></h1>
                        <h2>Made to modify and use anywhere</h2>
                        <div class="slide-text">
                                <ul>
                                		<li><span> </span> is an open source, non-relational, distributed database modeled after Google's BigTable and written in Java.</li>
                                        <li><span> </span>Is a column-oriented database management system that runs on top of HDFS </li>
                                        <li><span> </span>HBase applications are written in Java much like a typical MapReduce application</li>                                        
                                </ul>
                        </div>
                        <div class="clearfix"> </div>
                        <div class="big-btns">
                                        <a class="download" href="index.php?r=user/intro&model=hbase">Hbase Code generator</a>
                        </div>
                </div>
          </div>
        </li> -->
      </ul>
    </div>
    <div class="clearfix"> </div>

        <div class="divice-demo">
                <img src="images/big-data.png" title="demo" />
        </div>

</div>

<div id="fea" class="features">
        <div class="container">
                <div class="section-head text-center">
                        <h3><span class="frist"> </span>AMAZING FEATURES<span class="second"> </span></h3>
                        <p>Programming with Big Data become easy if you user BiCoGe, if will help you generate code in the specific case based on multiple programming languages​​.</p>
                </div>
       
                <div class="features-grids">
                        <div class="col-md-4 features-grid">
                                <div class="features-grid-info">
                                        <div class="col-md-2 features-icon">
                                                <span class="f-icon0"> </span>
                                        </div>
                                        <div class="col-md-10 features-info">
                                                <a href="index.php?r=user"><h4>MapReduce code generator</h4></a>                                                
                                        </div>
                                        <div class="clearfix"> </div>
                                </div>
                                <div class="features-grid-info">
                                        <div class="col-md-2 features-icon">
                                                <span class="f-icon1"> </span>
                                        </div>
                                        <div class="col-md-10 features-info">
                                                <h4>Code edit faster with Autocomplete code</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                </div>

                        </div><!---end-features-grid---->
                        <div class="col-md-4 features-grid">
                                <div class="big-divice">
                                        <img src="images/big-data-ft.png" title="features-demo" />
                                </div>
                        </div><!---end-features-grid---->
                        <div class="col-md-4 features-grid">
                                <div class="features-grid-info">
                                        <div class="col-md-2 features-icon1">
                                                <span class="f-icon3"> </span>
                                        </div>
                                        <div class="col-md-10 features-info">
                                                <h4>Create and Share your code</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                </div>
                                <div class="features-grid-info">
                                        <div class="col-md-2 features-icon1">
                                                <span class="f-icon4"> </span>
                                        </div>
                                        <div class="col-md-10 features-info">
                                                <h4>Various resources and document</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                </div>

                        </div><!---end-features-grid---->
                        <div class="clearfix"> </div>
                </div>
        </div>

        <div id="about" class="team">
                <div class="container">
                        <div class="section-head text-center">
                                <h3><span class="frist"> </span>TEAM BEHIND THE WEB<span class="second"> </span></h3>
                                <p> We will never know our limits until we push ourselves to them. Be happy even if things aren't perfect now</p>
                        </div>
                </div>
                <div class="team-members">
                        <div class="container">
                                <div class="col-md-6 team-member">
                                        <div class="team-member-info">
                                                <img class="member-pic" src="images/hoa.jpg" title="name" />
                                                <h5><a href="#">Lê Hoàng Hòa</a></h5>
                                                <span>Web Developer & Designer</span>
                                                <label class="team-member-caption text-center">
                                                        <p>Do not lose hold of your dreams or asprirations. For if you do, you may still exist but you have ceased to live.</p>
                                                        <ul>
                                                                <li><a class="t-twitter" href="#"><span> </span></a></li>
                                                                <li><a class="t-facebook" href="https://www.facebook.com/hoanghoa1992"><span> </span></a></li>
                                                                <li><a class="t-googleplus" href="#"><span> </span></a></li>
                                                                <div class="clearfix"> </div>
                                                        </ul>
                                                </label>
                                        </div>
                                </div>
                                <div class="col-md-6 team-member">
                                        <div class="team-member-info">
                                                <img class="member-pic" src="images/duyen.jpg" title="name" />
                                                <h5><a href="#">Đỗ Thị Duyên</a></h5>
                                                <span>Data Engineer </span>
                                                <label class="team-member-caption text-center">
                                                        <p>Trust in dreams, for in them is hidden the gate to eternity.</p>
                                                        <ul>
                                                                <li><a class="t-twitter" href="#"><span> </span></a></li>
                                                                <li><a class="t-facebook" href="https://www.facebook.com/dothiduyen92"><span> </span></a></li>
                                                                <li><a class="t-googleplus" href="#"><span> </span></a></li>
                                                                <div class="clearfix"> </div>
                                                        </ul>
                                                </label>
                                        </div>
                                </div>
                               
                                <div class="clearfix"> </div>
                        </div>
                                <div class="clearfix"> </div>
                </div>
        </div>
        <div class="clearfix"> </div>
       