<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>PNHS</title>
        <link rel="shortcut icon" href="{{ asset('image/logo/logo.png') }}">
      
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    
        <!-- CSS Libraries -->
        @yield('moreCss')
        <link rel="stylesheet" href="{{ asset('css/toast/iziToast.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components.css') }}">
        
      </head>
      
      <body class="layout-3">
        <div id="app">
            <div class="main-wrapper container">
              <div class="navbar-bg" style="background: #000284"></div>
              <nav class="navbar navbar-expand-lg main-navbar">
                <div class="container">
                    <a href="index.html" class="navbar-brand sidebar-gone-hide">
                        <img class="img-fluid m-0 p-0" src="{{ asset('image/logo/logo.png') }}"
                        alt="PNHS LOGO" width="44px">
                        PNHS
                    </a>
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                   
                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown dropdown-list-toggle">
                            <a  class="nav-link nav-link-lg text-white"><i class="fas fa-graduation-cap" style="font-size: 13px"></i>&nbsp;&nbsp;Curriculum</a>
                        </li>
                      <li class="dropdown dropdown-list-toggle">
                          <a href="{{ route('auth.login') }}" class="nav-link nav-link-lg text-white"><i class="fas fa-sign-in-alt" style="font-size: 13px"></i>&nbsp;&nbsp;Login</a>
                      </li>
                    </ul>
                </div>
              </nav>
        
              <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-rocket"></i><span>Vision & Mission</span></a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-history"></i><span>History</span></a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link"><i class="far fa-lightbulb"></i><span>Activities</span></a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-info-circle"></i><span>Contact info</span></a>
                      </li>
                  </ul>
                </div>
              </nav>
        
              <!-- Main Content -->
              <div class="main-content">
                <section class="section">
                    
                      <div class="row">
                        <div class="col-12 mb-4 mt-3">
                            <div  class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url({{ asset('image/logo/header-bg1.jpg') }});padding:10%">
                              <div class="hero-inner text-center">
                                  <img class="img-fluid m-0 p-0" src="{{ asset('image/logo/logo.png') }}" width="80px">
                                <h5 class="mt-1 lead"><em>Welcome, to our school !</em></h5>
                                <h1 class="mt-2 display-4">PILI NATIONAL HIGH SCHOOL</h1>
                                <em>"A community of lifelong learners, responsible global citizens, and champions of our own success."</em>
                               
                              </div>
                            </div>
                          </div>
                          {{--  --}}
                          <div class="row">
                              <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                               <div class="row">
                                <div class="col-lg-6">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h4>Get Appointment</h4>
                                      </div>
                                      <div class="card-body">
                                          <p>
                                              These online services of the school aim to avoid the crowd at the school premises observing the COVID-19 health protocols.
                                          </p>
                                          <a href="{{ route('appoint') }}" class="btn btn-primary btn-icon">
                                              <i class="fas fa-eye"></i>
                                              Get Appointment
                                          </a>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card card-info">
                                      <div class="card-header">
                                          <h4>Pre Enrollment</h4>
                                      </div>
                                      <div class="card-body">
                                          <p>
                                            They want the experience to be easy, accessible, and welcoming. Paper enrollment forms are becoming a thing of the past.
                                          </p>
                                          <a href="{{ route('welcome') }}" class="btn btn-primary btn-icon">
                                              <i class="fas fa-eye"></i>
                                              Pre Enroll online now
                                          </a>
                                      </div>
                                    </div>
                                </div> 
                               </div>
                              </div>
                              <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                  <div class="card card-primary">
                                      <div class="card-header">
                                         <h4>Blended Learning</h4>
                                      </div>
                                      <div class="card-body">
                                          <p><i class="fas fa-chalkboard-teacher" style="font-size: 28px"></i> <span style="font-size: 20px">A</span>
                                            <small>
                                                manner of learning where online and modular learning are fused. When a student receives the module from the barangay kiosks, they will be able to reach out to their teachers online within a given time schedule.
                                               A student and a teacher are able to interact with each other using technological innovations that can even boost the learner’s learning experience. They will also be able to meet with their classmates using open online classrooms. <span class="text-warning">see more...</span>
                                            </small>
                                        </p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    {{--  --}}
                
        
                  <div class="section-body">
                    <h1 class="section-title">Vision & Mission</h1>
                    <p class="section-lead">This page is just an example for you to create your own page.</p>

                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="pricing">
                              <div class="pricing-title" style="font-size: 20px">
                                Vision
                              </div>
                              <div class="pricing-padding">
                                <div class="pricing-price">
                                 <div>
                                    <i class="fas fa-eye" style="font-size: 60px"></i>
                                 </div>
                                </div>
                               <div class="text-muted">
                                <p>To protect and promote the right of every Filipino to quality, equitably, culture-based, and complete basic education where:</p>
                               
                                <ul class="text-left p-1">
                                    <li>
                                        <p>Students learn in a child-friendly, gender-sensitive, safe, and motivating environment</p>
                                    </li>
                                    <li>
                                        <p>Teachers facilitate learning and constantly nurture every learner</p>
                                    </li>
                                </ul>
                            </div>
                              </div>
                            </div>
                          </div>

                          {{--  --}}
                          
                          {{--  --}} 

                          <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing">
                            <div class="pricing-title" style="font-size: 20px">
                                Mission
                              </div>
                            <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>
                                    <i class="fas fa-rocket" style="font-size: 60px"></i>
                                 </div>
                            </div>
                          <div class="text-muted">
                              <p>We dream of Filipinos who passionately love their country and whose values and competencies enable them to realize their 
                                  full potential and contribute meaningfully to building the nation. As a learner-centered public institution, the Department of Education continuously improves itself to better serve its stakeholders.</p>
                          </div>
                            </div>
                        </div>
                        </div>
                        {{--  --}}
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="pricing">
                                <div class="pricing-title" style="font-size: 20px">
                                    Core Values
                                  </div>
                              <div class="pricing-padding">
                                <div class="pricing-price">
                                    <div>
                                        <i class="fas fa-check-circle" style="font-size: 60px"></i>
                                     </div>
                                </div>
                                <div class="pricing-details">
                                  <div class="pricing-item" >
                                    <div class="pricing-item-icon mt-2"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label" style="font-size: 22px" >Maka-Diyos</div>
                                  </div>
                                  <div class="pricing-item">
                                    <div class="pricing-item-icon mt-2"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label" style="font-size: 22px" >Makatao</div>
                                  </div>
                                  <div class="pricing-item">
                                    <div class="pricing-item-icon mt-2"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label" style="font-size: 22px" >Makakalikasan</div>
                                  </div>
                                  <div class="pricing-item">
                                    <div class="pricing-item-icon mt-2"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label" style="font-size: 22px" >Makabansa</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{--  --}}
                    </div>

                    <h1 class="section-title">School Activity</h1>
                    <p class="section-lead">This page is just an example for you to create your own page.</p>

                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <article class="article article-style-c">
                              <div class="article-header">
                                <div class="article-image" data-background="{{ asset('image/logo/a1.png') }}">
                                </div>
                              </div>
                              <div class="article-details">
                                
                                <div class="article-title">
                                  <h2><a href="#">Bansang kaunlaran Buwan ng Wikang Pambansa</a></h2>
                                </div>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. </p>
                                <div class="article-user">
                                  <img alt="image" src="{{ asset('image/logo/1.jpg') }}">
                                  <div class="article-user-details">
                                    <div class="user-detail-name">
                                      <a href="#">The Rainbow</a>
                                    </div>
                                    <div class="text-job">School Publication</div>
                                  </div>
                                </div>
                              </div>
                            </article>
                          </div>
                          {{--  --}}
                          <div class="col-12 col-md-4 col-lg-4">
                            <article class="article article-style-c">
                              <div class="article-header">
                                <div class="article-image" data-background="{{ asset('image/logo/a2.jpg') }}">
                                </div>
                              </div>
                              <div class="article-details">
                                
                                <div class="article-title">
                                  <h2><a href="#">English Month Activity</a></h2>
                                </div>
                                <p>
                                    Croquet is tough. People play for months because the rules are so bizarre Those crazy English
                                </p>
                                <div class="article-user">
                                  <img alt="image" src="{{ asset('image/logo/1.jpg') }}">
                                  <div class="article-user-details">
                                    <div class="user-detail-name">
                                      <a href="#">The Rainbow</a>
                                    </div>
                                    <div class="text-job">School Publication</div>
                                  </div>
                                </div>
                              </div>
                            </article>
                          </div>
                          {{--  --}}
                          <div class="col-12 col-md-4 col-lg-4">
                            <article class="article article-style-c">
                              <div class="article-header">
                                <div class="article-image" data-background="{{ asset('image/logo/a3.jpg') }}">
                                </div>
                              </div>
                              <div class="article-details">
                                
                                <div class="article-title">
                                  <h2><a href="#">Plant a tree for National Tree Planting Day</a></h2>
                                </div>
                                <p>When done well, tree planting is recognised as one of the most engaging, environmentally friendly activities that people can take part in to better</p>
                                <div class="article-user">
                                  <img alt="image" src="{{ asset('image/logo/1.jpg') }}">
                                  <div class="article-user-details">
                                    <div class="user-detail-name">
                                      <a href="#">The Rainbow</a>
                                    </div>
                                    <div class="text-job">School Publication</div>
                                  </div>
                                </div>
                              </div>
                            </article>
                          </div>
                    </div>

                    <h1 class="section-title">History</h1>
                    <p class="section-lead">This page is just an example for you to create your own page.</p>

                    <div class="card">
                      <div class="card-header">
                        <h4>PNHS HISTORY</h4>
                      </div>
                      <div class="card-body">
                      <p>
                        Pili National High School was founded in 1970 by former Municipal Mayor of Pili, Hon. Jose B. Velarde. It was then occupying the facilities of Marcos Stadium, now, the Freedom Sports Complex where the Division Office is located. The establishment of PNHS was very much different from other secondary schools. When PNHS was opened in 1970, all 52 enrollees were selected from the different barangays of Pili for this reason, it was dubbed as Pili Special Barrio High School. Likewise, the salaries of the teachers were defrayed by the local government of Pili. However, there were only 26 graduates in 1974. The Municipal Council of Pili continued the scholarship program until 1980 to the indigent residents of Pili.

                        The first principal was Mr. Jose T. Malanyaon while the first teacher was Ms. Maria Busadre. Mr. Gregorio Ayen, Mrs. Catalina Malanyaon, and Mr. Domingo Vargas were the part time teachers. Due to the increase of enrolment, permanent teachers were hired. They were Mrs. Tecla V. Nano, Mrs. Editha T. Ballester-Secondary Head Teacher III, Mr. Romeo P. Permelona-Master Teacher II, and Ms. Francia V. Felizminio now Atty. Francia F. Apongol.
            
                          In 1976, there were 20 teachers and due to this development, Mr Germites C. Dineros was assigned Principal I. The growth of the school prompted the government to shoulder the salaries of the teachers and other financial matters.
                      </p>
                      </div>
                      <div class="card-footer bg-whitesmoke">
                        This is card footer
                      </div>
                    </div>
                  </div>
                </section>
              </div>
              <footer class="main-footer">
                <div class="footer-left">
                  Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                </div>
                <div class="footer-right">
                  
                </div>
              </footer>
            </div>
          </div>
      
        <!-- General JS Scripts -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/stisla.js') }}"></script>
        
        <!-- JS Libraies -->
      
        <!-- Page Specific JS File -->
        
        <!-- Template JS File -->
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
      </body>
  
</html>
