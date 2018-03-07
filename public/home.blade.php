@include('header')

<!-- Start Banner -->
<section id="banner">
  <div class="banner-bg">
    <div class="banner-bg-item"><img src="img/backgroundImage.jpg" alt=""></div>
    <div class="banner-bg-item"><img src="img/backgroundImage.jpg"></div>
  </div>

  <div class="css-table">
    <div class="css-table-cell">

      <!-- Start Banner-Search -->
      <div class="banner-search">
        <div class="container">
          <div id="hero-tabs" class="banner-search-inner">
            <ul class="custom-list tab-title-list clearfix">
              <li class="tab-title active"><a href="#">Reservation</a></li>
              <li class="tab-title"><a href="#pricingtab" class="tab-pricing hide">Pricing</a></li>
            </ul>
            <ul class="custom-list tab-content-list">
                
                @if(!empty($step))
                  @include("step{$step}")
                @endif 
                
            </ul>

          </div>

        </div>
      </div>
      <!-- End Banner-Search -->

    </div>
  </div>
</section>
<!-- End Banner -->
<!-- Start About -->
<section class="about">
  <div class="container">
    <div class="row">
      <div class="preamble col-md-12">
        <h3><a id="aboutrockypoint">About Rocky Point - Puerto Penasco</a></h3>
        <p>We are so glad you found us, and you will too. We have been Rocky Point's Official Travel Agency since 1999.  We specialize in beachfront condos, villas and hotels. Whether this is your first time in Puerto Peñasco -better known as Rocky Point, Mexico- or you are a frequent visitor, our knowledgeable staff will make the reservation process a breeze. We represent only the best Rocky Point has to offer. We truly know Rocky Point. Our staff inspects every property, in order to become intimately familiar with all the amenities before they are listed in our inventory. Visit our Gallery section and find out for yourself.  We have been booking Rocky Point Rentals since 1999. "THE CLOSEST YOU ARE TO BEING FAR AWAY!".</p>

        <p>At Rocky Point Travel, we know how important your vacation is. If you are like us, you want the planning to be easy, fast, and personalized so you can get right to the good stuff - the actual trip. With so many vacation options available, it's helpful to work with someone with experience and who can guide you through the entire planning process. We are your friend in the business who can give you insider tips to help you have a unique and memorable experience.  Our Rocky Point Resorts will satisfy the most discriminating taste.  Book your Rocky Point reservations with us.</p>

        <p>Summer and Winter alike, let the seasons be your inspiration. Rocky Point Travel properties have a whole orchestra of amenities to offer you a real symphony of pleasure. Insulated from the outside world, yet only one hour from the U.S. border or 3.5 hours from Phoenix or Tucson, Rocky Point provides self-contained enclaves along the best beaches in the area. Take a Mexican vacation close to home, without the hassle of air travel, passports, visas or customs. Make your reservation online 24 hours a day - It is Simple & Secure! </p>

        <p>Browse through our Web site to familiarize yourself with our properties and make your reservation online, or just call us.  Do not delay. Let Rocky Point Travel introduce you, or take you back, to your home away from home. Are you ready for a quote or to book your reservation? Just make your online Rocky Point Reservations here.</p>

        <p>Need Mexican insurance? It is Mexican law. You can get it right here too.  The name says it all: WE ARE ROCKY POINT'S TRAVEL AGENCY. One last thing. The best complement we can receive is when a rental client recommends us to a friend or relative. We hope you do the same. Share your vacation experience with us.</p>

      </div>
      <!--div class="col-md-3 col-sm-6 feature text-center">
        <div class="overlay">
          <img src="img/about1.jpg" alt="" class="img-responsive">
          <div class="overlay-shadow">
            <div class="overlay-content">
              <a href="#" class="btn btn-transparent-white">Read More</a>
            </div>
          </div>
        </div>
        <h4>Our Services</h4>
        <p>Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.</p>
      </div>

      <div class="col-md-3 col-sm-6 feature text-center">
        <div class="overlay">
          <img src="img/about2.jpg" alt="" class="img-responsive">
          <div class="overlay-shadow">
            <div class="overlay-content">
              <a href="#" class="btn btn-transparent-white">Read More</a>
            </div>
          </div>
        </div>
        <h4>Memberships</h4>
        <p>Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.</p>
      </div>

     <div class="col-md-3 col-sm-6 feature text-center">
        <div class="overlay">
          <img src="img/about3.jpg" alt="" class="img-responsive">
          <div class="overlay-shadow">
            <div class="overlay-content">
              <a href="#" class="btn btn-transparent-white">Read More</a>
            </div>
          </div>
        </div>
        <h4>Our Agents</h4>
        <p>Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.</p>
      </div>

      <div class="col-md-3 col-sm-6 feature text-center">
        <div class="overlay">
          <img src="img/about4.jpg" alt="" class="img-responsive">
          <div class="overlay-shadow">
            <div class="overlay-content">
              <a href="#" class="btn btn-transparent-white">Read More</a>
            </div>
          </div>
        </div>
        <h4>Our Offices</h4>
        <p>Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.</p>
      </div>
    </div-->
    </div>
</section>
<!-- End About -->
<!-- Start Testimonials -->
<section class="testimonials">

  <!-- Start Video Background -->
  <div id="video_testimonials" data-vide-bg="video/ocean" data-vide-options="position: 0% 50%"></div>
  <div class="video_gradient"></div>
  <!-- End Video Background -->

  <div class="container">
    <div class="row">
      <div class="preamble light col-md-12">
        <h3>Testimonials</h3>
      </div>

      <div class="col-md-12">
        <div id="owl-testimonials" class="owl-carousel owl-theme">

          <!-- Start Container Item -->
          <div class="item">
            <div class="col-lg-12">
              <blockquote class="quote">
                <cite>Nancy B<span class="job"></span></cite>
                <p class="stars">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </p>
                Our stay at this property was wonderful! The kitchen was spacious and had all the necessary items for cooking. The property was beautiful and private. The property was well maintained with spacious bathrooms and bedrooms. The beds were comfortable. The beach was a short walk but the private patio was perfect for sitting outside and reading or enjoying the sun. We highly recommend this property for your Rocky Point vacation!
              </blockquote>
            </div>
          </div>
          <!-- End Container Item -->

          <!-- Start Container Item -->
          <div class="item">
            <div class="col-lg-12">
              <blockquote class="quote">
                <cite>Ken S<span class="job"></span></cite>
                <p class="stars">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </p>
                Our stay was Awesome...the house itself was way more then we expected, three bedrooms, three baths...master bath was huge! Excellent kitchen fully stocked...built in bbq grill which we used everyday...built in jacuzzi which we used everyday...loved all the pools...the swim up bar was great..nice staff everywhere we went...the grounds maintained beautifully...short walk to beach...we hope to go back!
              </blockquote>
            </div>
          </div>
          <!-- End Container Item -->

          <!-- Start Container Item -->
          <div class="item">
            <div class="col-lg-12">
              <blockquote class="quote">
                <cite>Mastaneh G.<span class="job"></span></cite>
                <p class="stars">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </p>
                We enjoyed our stay at this wonderfully appointed villa. The owner was very professional throughout the rental process. The villa was very clean and conveniently located in the ground floor close the pool and the beach. We look forwarding renting this villa again.
              </blockquote>
            </div>
          </div>
          <!-- End Container Item -->

        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Testimonials -->

<div class="loading">
   Please Wait <i class="fa fa-spinner fa-spin"></i>
</div>

@include('footer')