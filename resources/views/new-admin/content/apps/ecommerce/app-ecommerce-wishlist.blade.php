@extends('layouts/contentLayoutMaster')

@section('title', 'WishList')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<!-- Wishlist Starts -->
<section id="wishlist" class="grid-view wishlist-items">
  <div class="card ecommerce-card">
    <div class="item-img text-center">
      <a href="{{url('app/ecommerce/details')}}">
        <img src="{{asset('images/pages/eCommerce/1.png')}}" class="img-fluid" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-wrapper">
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
          </ul>
        </div>
        <div class="item-cost">
          <h6 class="item-price">$19.99</h6>
        </div>
      </div>
      <div class="item-name">
        <a href="{{url('app/ecommerce/details')}}">Apple Watch Series 5</a>
      </div>
      <p class="card-text item-description">
        On Retina display that never sleeps, so it’s easy to see the time and other important information, without
        raising or tapping the display. New location features, from a built-in compass to current elevation, help users
        better navigate their day, while international emergency calling1 allows customers to call emergency services
        directly from Apple Watch in over 150 countries, even without iPhone nearby. Apple Watch Series 5 is available
        in a wider range of materials, including aluminium, stainless steel, ceramic and an all-new titanium.
      </p>
    </div>
    <div class="item-options text-center">
      <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
        <i data-feather="x"></i>
        <span>Remove</span>
      </button>
      <button type="button" class="btn btn-primary btn-cart move-cart">
        <i data-feather="shopping-cart"></i>
        <span class="add-to-cart">Move to cart</span>
      </button>
    </div>
  </div>

  <div class="card ecommerce-card">
    <div class="item-img text-center">
      <a href="{{url('app/ecommerce/details')}}">
        <img src="{{asset('images/pages/eCommerce/2.png')}}" class="img-fluid" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-wrapper">
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
          </ul>
        </div>
        <div class="item-cost">
          <h6 class="item-price">$4999.99</h6>
        </div>
      </div>
      <div class="item-name">
        <a href="{{url('app/ecommerce/details')}}">Apple iPhone 11 (64GB, Black)</a>
      </div>
      <p class="card-text item-description">
        The Apple iPhone 11 is a great smartphone, which was loaded with a lot of quality features. It comes with a
        waterproof and dustproof body which is the key attraction of the device. The excellent set of cameras offer
        excellent images as well as capable of recording crisp videos. However, expandable storage and a fingerprint
        scanner would have made it a perfect option to go for around this price range.
      </p>
    </div>
    <div class="item-options text-center">
      <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
        <i data-feather="x"></i>
        <span>Remove</span>
      </button>
      <button type="button" class="btn btn-primary btn-cart move-cart">
        <i data-feather="shopping-cart"></i>
        <span class="add-to-cart">Move to cart</span>
      </button>
    </div>
  </div>

  <div class="card ecommerce-card">
    <div class="item-img text-center">
      <a href="{{url('app/ecommerce/details')}}">
        <img src="{{asset('images/pages/eCommerce/3.png')}}" class="img-fluid" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-wrapper">
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
          </ul>
        </div>
        <div class="item-cost">
          <h6 class="item-price">$4499.99</h6>
        </div>
      </div>
      <div class="item-name">
        <a href="{{url('app/ecommerce/details')}}">Apple iMac 27-inch</a>
      </div>
      <p class="card-text item-description">
        The all-in-one for all. If you can dream it, you can do it on iMac. It’s beautifully & incredibly intuitive and
        packed with tools that let you take any idea to the next level. And the new 27-inch model elevates the
        experience in way, with faster processors and graphics, expanded memory and storage, enhanced audio and video
        capabilities, and an even more stunning Retina 5K display. It’s the desktop that does it all — better and faster
        than ever.
      </p>
    </div>
    <div class="item-options text-center">
      <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
        <i data-feather="x"></i>
        <span>Remove</span>
      </button>
      <button type="button" class="btn btn-primary btn-cart move-cart">
        <i data-feather="shopping-cart"></i>
        <span class="add-to-cart">Move to cart</span>
      </button>
    </div>
  </div>
  <div class="card ecommerce-card">
    <div class="item-img text-center">
      <a href="{{url('app/ecommerce/details')}}">
        <img src="{{asset('images/pages/eCommerce/4.png')}}" class="img-fluid" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-wrapper">
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
          </ul>
        </div>
        <div class="item-cost">
          <h6 class="item-price">$599.99</h6>
        </div>
      </div>
      <div class="item-name">
        <a href="{{url('app/ecommerce/details')}}">OneOdio A71 Wired Headphones</a>
      </div>
      <p class="card-text item-description">
        Omnidirectional detachable boom mic upgrades the headphones into a professional headset for gaming, business,
        podcasting and taking calls on the go. Better pick up your voice. Control most electric devices through voice
        activation, or schedule a ride with Uber and order a pizza. OneOdio A71 Wired Headphones voice-controlled device
        turns any home into a smart device on a smartphone or tablet.
      </p>
    </div>
    <div class="item-options text-center">
      <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
        <i data-feather="x"></i>
        <span>Remove</span>
      </button>
      <button type="button" class="btn btn-primary btn-cart move-cart">
        <i data-feather="shopping-cart"></i>
        <span class="add-to-cart">Move to cart</span>
      </button>
    </div>
  </div>

  <div class="card ecommerce-card">
    <div class="item-img text-center">
      <a href="{{url('app/ecommerce/details')}}">
        <img src="{{asset('images/pages/eCommerce/5.png')}}" class="img-fluid" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-wrapper">
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
          </ul>
        </div>
        <div class="item-cost">
          <h6 class="item-price">$649.99</h6>
        </div>
      </div>
      <div class="item-name">
        <a href="{{url('app/ecommerce/details')}}">Apple - MacBook Air® (Latest Model) - 13.3" Display - Silver</a>
      </div>
      <p class="card-text item-description">
        MacBook Air is a thin, lightweight laptop from Apple. MacBook Air features up to 8GB of memory, a
        fifth-generation Intel Core processor, Thunderbolt 2, great built-in apps, and all-day battery life.1 Its thin,
        light, and durable enough to take everywhere you go-and powerful enough to do everything once you get there,
        better.
      </p>
    </div>
    <div class="item-options text-center">
      <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
        <i data-feather="x"></i>
        <span>Remove</span>
      </button>
      <button type="button" class="btn btn-primary btn-cart move-cart">
        <i data-feather="shopping-cart"></i>
        <span class="add-to-cart">Move to cart</span>
      </button>
    </div>
  </div>

  <div class="card ecommerce-card">
    <div class="item-img text-center">
      <a href="{{url('app/ecommerce/details')}}">
        <img src="{{asset('images/pages/eCommerce/6.png')}}" class="img-fluid" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-wrapper">
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
          </ul>
        </div>
        <div class="item-cost">
          <h6 class="item-price">$1999.99</h6>
        </div>
      </div>
      <div class="item-name">
        <a href="{{url('app/ecommerce/details')}}">Switch Pro Controller </a>
      </div>
      <p class="card-text item-description">
        The Nintendo Switch Pro Controller is one of the priciest "baseline" controllers in the current console
        generation, but it's also sturdy, feels good to play with, has an excellent direction pad, and features
        impressive motion sensors and vibration systems. On top of all of that, it uses Bluetooth, so you don't need an
        adapter to use it with your PC.
      </p>
    </div>
    <div class="item-options text-center">
      <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
        <i data-feather="x"></i>
        <span>Remove</span>
      </button>
      <button type="button" class="btn btn-primary btn-cart move-cart">
        <i data-feather="shopping-cart"></i>
        <span class="add-to-cart">Move to cart</span>
      </button>
    </div>
  </div>

  <div class="card ecommerce-card">
    <div class="item-img text-center">
      <a href="{{url('app/ecommerce/details')}}">
        <img src="{{asset('images/pages/eCommerce/7.png')}}" class="img-fluid" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-wrapper">
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
          </ul>
        </div>
        <div class="item-cost">
          <h6 class="item-price">$39.99</h6>
        </div>
      </div>
      <div class="item-name">
        <a href="{{url('app/ecommerce/details')}}">Google - Google Home - White/Slate fabric </a>
      </div>
      <p class="card-text item-description">
        Simplify your everyday life with the Google Home, a voice-activated speaker powered by the Google Assistant. Use
        voice commands to enjoy music, get answers from Google and manage everyday tasks. Google Home is compatible with
        Android and iOS operating systems, and can control compatible smart devices such as Chromecast or Nest.
      </p>
    </div>
    <div class="item-options text-center">
      <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
        <i data-feather="x"></i>
        <span>Remove</span>
      </button>
      <button type="button" class="btn btn-primary btn-cart move-cart">
        <i data-feather="shopping-cart"></i>
        <span class="add-to-cart">Move to cart</span>
      </button>
    </div>
  </div>

  <div class="card ecommerce-card">
    <div class="item-img text-center">
      <a href="{{url('app/ecommerce/details')}}">
        <img src="{{asset('images/pages/eCommerce/8.png')}}" class="img-fluid" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-wrapper">
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
          </ul>
        </div>
        <div class="item-cost">
          <h6 class="item-price">$3199.99</h6>
        </div>
      </div>
      <div class="item-name">
        <a href="{{url('app/ecommerce/details')}}">Sony 4K Ultra HD LED TV </a>
      </div>
      <p class="card-text item-description">
        Sony 4K Ultra HD LED TV has 4K HDR Support. The TV provides clear visuals and provides distinct sound quality
        and an immersive experience. This TV has Yes HDMI ports & Yes USB ports. Connectivity options included are HDMI.
        You can connect various gadgets such as your laptop using the HDMI port. The TV comes with a 1 Year warranty.
      </p>
    </div>
    <div class="item-options text-center">
      <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
        <i data-feather="x"></i>
        <span>Remove</span>
      </button>
      <button type="button" class="btn btn-primary btn-cart move-cart">
        <i data-feather="shopping-cart"></i>
        <span class="add-to-cart">Move to cart</span>
      </button>
    </div>
  </div>

  <div class="card ecommerce-card">
    <div class="item-img text-center">
      <a href="{{url('app/ecommerce/details')}}">
        <img src="{{asset('images/pages/eCommerce/9.png')}}" class="img-fluid" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-wrapper">
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
          </ul>
        </div>
        <div class="item-cost">
          <h6 class="item-price">$4399.99</h6>
        </div>
      </div>
      <div class="item-name">
        <a href="{{url('app/ecommerce/details')}}">OnePlus 7 Pro </a>
      </div>
      <p class="card-text item-description">
        The OnePlus 7 Pro features a brand new design, with a glass back and front and curved sides. The phone feels
        very premium but’s it’s also very heavy. The Nebula Blue variant looks slick but it’s quite slippery, which
        makes single-handed use a real challenge. It has a massive 6.67-inch ‘Fluid AMOLED’ display with a QHD+
        resolution, 90Hz refresh rate and support for HDR 10+ new-admin.content. The display produces vivid colours, deep blacks
        and has good viewing angles.
      </p>
    </div>
    <div class="item-options text-center">
      <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
        <i data-feather="x"></i>
        <span>Remove</span>
      </button>
      <button type="button" class="btn btn-primary btn-cart move-cart">
        <i data-feather="shopping-cart"></i>
        <span class="add-to-cart">Move to cart</span>
      </button>
    </div>
  </div>
</section>
<!-- Wishlist Ends -->
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-wishlist.js')) }}"></script>
@endsection
