@extends('layouts.landing.main')

@section('content')
  <!-- Hero Area -->
  <section class="vs-hero vs-hero--style2 z-index-common wow animate__fadeInUp" data-wow-delay="0.25s" aria-hidden="true">
      <div class="vs-carousel" data-fade="true">
          <div class="slick-slide" aria-hidden="true">
              <div class="vs-hero__item" data-bg-src="{{ asset('landing/img/bg/h1-hero-2-1.png') }}">
                  <img src="{{ asset('landing/img/hero/hero-img-2-1.png') }}" alt="hero element" class="hero-ele1">
                  <img src="{{ asset('landing/img/hero/hero-img-2-2.png') }}" alt="hero element" class="hero-ele2">
                  <img src="{{ asset('landing/img/hero/hero-img-2-3.png') }}" alt="hero element" class="hero-ele3">
                  <img src="{{ asset('landing/img/hero/hero-img-2-4.png') }}" alt="hero element" class="hero-ele4">
                  <div class="container">
                      <div class="row align-items-center gy-4">
                          <div class="col-lg-7">
                              <div class="vs-hero__content">
                                  <div class="vs-hero__title--sub">
                                      <div class="vs-hero__loading">
                                          <div class="vs-hero__bar vs-hero__bar--small"></div>
                                          <div class="vs-hero__bar"></div>
                                          <div class="vs-hero__bar"></div>
                                          <div class="vs-hero__bar"></div>
                                          <div class="vs-hero__bar"></div>
                                          <div class="vs-hero__bar"></div>
                                          <div class="vs-hero__bar"></div>
                                          <div class="vs-hero__bar"></div>
                                      </div>
                                      <span>Let's Begin</span>
                                  </div>
                                  <h1 class="vs-hero__title"><span class="vs-hero__title--highlight">Innovation</span>
                                      Made Visible</h1>
                                  <h3 class="vs-hero__text">ITSK Empowering Future <span>Innovators</span>
                                  </h3>
                                  <div class="vs-hero__buttons" aria-hidden="true">
                                      <a href="#projects" class="vs-btn vs-btn--style2" tabindex="-1">
                                          view more
                                          <span class="vs-btn__inner">
                                              <span class="vs-btn__blobs">
                                                  <span class="vs-btn__blob"></span>
                                                  <span class="vs-btn__blob"></span>
                                                  <span class="vs-btn__blob"></span>
                                                  <span class="vs-btn__blob"></span>
                                              </span>
                                          </span>
                                          <svg class="vs-btn__animation" xmlns="http://www.w3.org/2000/svg"
                                              version="1.1">
                                              <defs>
                                                  <filter>
                                                      <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10">
                                                      </feGaussianBlur>
                                                      <feColorMatrix in="blur" type="matrix"
                                                          values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 21 -7"
                                                          result="goo">
                                                      </feColorMatrix>
                                                      <feBlend in2="goo" in="SourceGraphic" result="mix"></feBlend>
                                                  </filter>
                                              </defs>
                                          </svg>
                                      </a>
                                      <a href="https://www.youtube.com/watch?v=KECaSQWva_4"
                                          class="vs-hero__play play-btn popup-video" tabindex="-1">
                                          <i class="fa-solid fa-play"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-5">
                              <div class="vs-hero__image">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="breadcumb-shape">
          <span class="breadcumb-shape__one"></span>
          <span class="breadcumb-shape__two"></span>
          <span class="breadcumb-shape__three"></span>
      </div>
  </section>
  <!-- Hero Area End -->
  <section id="projects" class="space space-extra-bottom overflow-hidden">
      <div class="container">
          <div class="row align-items-end justify-content-between">
              <div class="col-lg-auto wow animate__fadeInUp" data-wow-delay="0.25s">
                  <div class="title-style title-style--style2 left">
                      <span class="title-style__small">
                          Our Projects
                          <svg width="79" height="6" viewBox="0 0 79 6" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path d="M4 0L0 3.2L4 6H38L39.5 3.4L41.5 6H75L78.5 3.2L75 0H41.5L39.5 2.2L38 0H4Z"
                                  fill="#A6D719">
                              </path>
                          </svg>
                      </span>
                      <h2 class="title-style__big">
                          Top Projects
                      </h2>
                  </div>
              </div>
              <div class="col-lg-auto wow animate__fadeInUp" data-wow-delay="0.45s">
                  <div class="title-style title-style--right-side">
                      <a href="nft-shop.html" class="title-style__link">
                          Explore More
                          <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M5.99974 12H0.545301C0.324942 12 0.125857 11.8669 0.0413135 11.6635C-0.0432303 11.4595 0.00367525 11.2249 0.159672 11.0689L5.22848 6L0.159672 0.931091C0.00367525 0.775091 -0.0432303 0.540546 0.0413135 0.336546C0.125857 0.133091 0.324942 0 0.545301 0H5.99974C6.14428 0 6.28337 0.0572723 6.38537 0.159818L11.8398 5.61436C12.0531 5.82709 12.0531 6.17291 11.8398 6.38564L6.38537 11.8402C6.28337 11.9427 6.14428 12 5.99974 12Z"
                                  fill="#A6D719" />
                              <path
                                  d="M5.58204 6.35355L5.93558 6L5.58204 5.64645L0.513229 0.577541C0.499968 0.56428 0.496265 0.54475 0.503218 0.527973L0.0413135 0.336546L0.503036 0.528411C0.510189 0.511198 0.52731 0.5 0.545301 0.5H5.99974C6.01248 0.5 6.02361 0.505122 6.03087 0.512425L6.03181 0.513368L11.4862 5.96791L11.4867 5.96837C11.5041 5.98573 11.5041 6.01427 11.4867 6.03163L11.4862 6.03209L6.03181 11.4866L6.03087 11.4876C6.02361 11.4949 6.01248 11.5 5.99974 11.5H0.545301C0.527459 11.5 0.510476 11.489 0.503218 11.472C0.496265 11.4553 0.499969 11.4357 0.513229 11.4225L5.58204 6.35355Z"
                                  stroke="#A6D719" stroke-opacity="0.2" />
                          </svg>
                      </a>
                  </div>
              </div>
          </div>
          <div class="container">
              <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-6">
                      <div class="vs-nfts">
                          <div class="vs-nfts__header">
                              <a class="vs-nfts__vendor" href="nft-shop.html">
                                  <img src="{{ asset('landing/img/nft/nft-shop-1-1.png') }}" style="max-width: 38px;"
                                      alt="avatar-icon" class="rounded-circle">
                                  Firdaus
                              </a>
                          </div>
                          <a class="vs-nfts__img--link" href="nft-shop.html">
                              <img src="{{ asset('landing/img/nft/nft-shop-thumb-2-1.jpg') }}" alt=""
                                  class="vs-nfts__img">
                          </a>
                          <div class="vs-nfts__content">
                              <h3 class="vs-nfts__title">
                                  <a class="vs-nfts__title--link" href="nft-shop.html">monket # 4001</a>
                              </h3>
                              <span class="text-secondary">
                                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore, autem
                                  deserunt!
                              </span>
                              <hr>
                              <div class="d-flex justify-content-start align-items-center gap-3">
                                  <span>
                                      <i class="fa-solid fa-eye"></i>
                                      100
                                  </span>
                                  <span class="text-danger">
                                      <i class="fa-solid fa-heart"></i>
                                      100
                                  </span>
                                  <span class="text-secondary ms-auto" style="font-size: 12px;">
                                      4 Jam yang lalu
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
@endsection
