@extends('layouts/contentLayoutMaster')

@section('title', 'Basic Card')

@section('content')
<!-- Examples -->
<section id="card-demo-example">
  <div class="row match-height">
    <div class="col-md-6 col-lg-4">
      <div class="card">
        <img class="card-img-top" src="{{asset('images/slider/04.jpg')}}" alt="Card image cap" />
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's new-admin.content.
          </p>
          <a href="#" class="btn btn-outline-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <h6 class="card-subtitle text-muted">Support card subtitle</h6>
        </div>
        <img class="img-fluid" src="{{asset("images/slider/03.jpg")}}" alt="Card image cap" />
        <div class="card-body">
          <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <h6 class="card-subtitle text-muted">Support card subtitle</h6>
          <img class="img-fluid my-2" src="{{asset('images/slider/06.jpg')}}" alt="Card image cap" />
          <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Examples -->

<!-- Content types -->
<section id="card-content-types">
  <h5 class="mt-3">Content Types</h5>

  <div class="row">
    <div class="col-md-6 col-lg-4">
      <h6 class="my-2 text-muted">Body</h6>
      <div class="card mb-4">
        <div class="card-body">
          <p class="card-text">
            This is some text within a card body. Jelly lemon drops tiramisu chocolate cake cotton candy soufflé oat
            cake sweet roll. Sugar plum marzipan dragée topping cheesecake chocolate bar. Danish muffin icing donut.
          </p>
        </div>
      </div>
      <h6 class="my-2 text-muted">Titles, Text, and Links</h6>
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <div class="card-subtitle text-muted mb-1">Card subtitle</div>
          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's new-admin.content.
          </p>
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
      </div>
      <h6 class="my-2 text-muted">List Groups</h6>
      <div class="card mb-4">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Vestibulum at eros</li>
        </ul>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <h6 class="my-2 text-muted">Images</h6>
      <div class="card mb-4">
        <img class="card-img-top" src="{{asset('images/slider/01.jpg')}}" alt="Card image cap" />
        <div class="card-body">
          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's new-admin.content.
          </p>
          <p class="card-text">
            Cookie topping caramels jujubes gingerbread. Lollipop apple pie cupcake candy canes cookie ice cream. Wafer
            chocolate bar carrot cake jelly-o.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <h6 class="my-2 text-muted">Kitchen Sink</h6>
      <div class="card">
        <img class="card-img-top" src="{{asset('images/slider/02.jpg')}}" alt="Card image cap" />
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">Some quick example text to build on the card title.</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Vestibulum at eros</li>
        </ul>
        <div class="card-body">
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
      </div>
    </div>
  </div>

  <h6 class="my-2 text-muted">Header and Footer</h6>
  <div class="row">
    <div class="col-md-6 col-lg-4">
      <div class="card">
        <div class="card-header">Featured</div>
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">
            With supporting text below as a natural lead-in to additional content natural lead-in to additional new-admin.content.
          </p>
          <a href="#" class="btn btn-outline-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card">
        <h6 class="card-header">Quote</h6>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.Lorem ipsum dolor sit
              amet, Integer posuere erat a ante Integer posuere erat a anteconsectetur.
            </p>
            <footer class="blockquote-footer">
              Someone famous in
              <cite title="Source Title">Source Title</cite>
            </footer>
          </blockquote>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card text-center">
        <div class="card-header">Featured</div>
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural.</p>
          <a href="#" class="btn btn-outline-primary">Go somewhere</a>
        </div>
        <div class="card-footer text-muted">2 days ago</div>
      </div>
    </div>
  </div>
</section>
<!--/ Content types -->

<!-- Text alignment -->
<section id="card-text-alignment">
  <h5 class="mt-3 mb-2">Text Alignment</h5>
  <div class="row">
    <div class="col-md-6 col-lg-4">
      <div class="card mb-3">
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional new-admin.content.</p>
          <a href="#" class="btn btn-outline-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card text-center mb-3">
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional new-admin.content.</p>
          <a href="#" class="btn btn-outline-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card text-end mb-3">
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional new-admin.content.</p>
          <a href="#" class="btn btn-outline-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Text alignment -->

<!-- Navigation -->
<section id="card-navigation">
  <h5 class="mt-3 mb-2">Navigation</h5>
  <div class="row">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-header py-2">
          <ul class="nav nav-pills card-header-pills ms-0" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="pills-home-tab"
                data-bs-toggle="pill"
                href="#pills-home"
                role="tab"
                aria-controls="pills-home"
                aria-selected="true"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="pills-profile-tab"
                data-bs-toggle="pill"
                href="#pills-profile"
                role="tab"
                aria-controls="pills-profile"
                aria-selected="false"
                >Profile</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional new-admin.content.</p>
              <a href="#" class="btn btn-outline-primary">Go home</a>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional new-admin.content.</p>
              <a href="#" class="btn btn-outline-primary">Go profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card text-center mb-3">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs ms-0" id="nav-tabs" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="home-tab"
                data-bs-toggle="tab"
                href="#home"
                role="tab"
                aria-controls="home"
                aria-selected="true"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="profile-tab"
                data-bs-toggle="tab"
                href="#profile"
                role="tab"
                aria-controls="profile"
                aria-selected="false"
                >Profile</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional new-admin.content.</p>
              <a href="#" class="btn btn-outline-primary">Go home</a>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional new-admin.content.</p>
              <a href="#" class="btn btn-outline-primary">Go profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Navigation -->

<!-- Images -->
<section id="card-images">
  <h5 class="mt-3 mb-2">Images</h5>
  <div class="row">
    <div class="col-md-6 col-xl-4">
      <div class="card mb-3">
        <img class="card-img-top" src="{{asset('images/slider/06.jpg')}}" alt="Card image cap" />
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">
            This is a wider card with supporting text below as a natural lead-in to additional new-admin.content. This content is
            a little bit longer.
          </p>
          <p class="card-text">
            <small class="text-muted">Last updated 3 mins ago</small>
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-3">
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">
            This is a wider card with supporting text below as a natural lead-in to additional new-admin.content. This content is
            a little bit longer.
          </p>
          <p class="card-text">
            <small class="text-muted">Last updated 3 mins ago</small>
          </p>
        </div>
        <img class="card-img-bottom" src="{{asset('images/slider/09.jpg')}}" alt="Card image cap" />
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card border-0 text-white">
        <img class="card-img" src="{{asset('images/slider/10.jpg')}}" alt="Card image" />
        <div class="card-img-overlay bg-overlay">
          <h4 class="card-title text-white">Card title</h4>
          <p class="card-text">
            This is a wider card with supporting text below as a natural lead-in to additional new-admin.content. This content is
            a little bit longer.
          </p>
          <p class="card-text">
            <small class="text-muted">Last updated 3 mins ago</small>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Images -->

<!-- Style variation -->
<section id="card-style-variation">
  <h5 class="mt-3 mb-2">Style Variation</h5>
  <!-- Solid -->
  <div class="row">
    <div class="col-md-6 col-xl-4">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <h4 class="card-title text-white">Primary card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card bg-secondary text-white">
        <div class="card-body">
          <h4 class="card-title text-white">Secondary card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card bg-success text-white">
        <div class="card-body">
          <h4 class="card-title text-white">Success card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card bg-danger text-white">
        <div class="card-body">
          <h4 class="card-title text-white">Danger card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card bg-warning text-white">
        <div class="card-body">
          <h4 class="card-title text-white">Warning card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card bg-info text-white">
        <div class="card-body">
          <h4 class="card-title text-white">Info card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Outline -->
  <div class="row">
    <div class="col-md-6 col-xl-4">
      <div class="card shadow-none bg-transparent border-primary">
        <div class="card-body">
          <h4 class="card-title">Primary card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card shadow-none bg-transparent border-secondary">
        <div class="card-body">
          <h4 class="card-title">Secondary card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card shadow-none bg-transparent border-success">
        <div class="card-body">
          <h4 class="card-title">Success card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card shadow-none bg-transparent border-danger">
        <div class="card-body">
          <h4 class="card-title">Danger card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card shadow-none bg-transparent border-warning">
        <div class="card-body">
          <h4 class="card-title">Warning card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card shadow-none bg-transparent border-info">
        <div class="card-body">
          <h4 class="card-title">Info card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Style variation -->

<!-- Card layout -->
<section class="card-layout">
  <h5 class="mt-3 mb-2">Card Layout</h5>

  <h6 class="my-3 text-muted">Card Groups</h6>
  <div class="card-group">
    <div class="card">
      <img class="card-img-top" src="{{asset('images/slider/01.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h4 class="card-title">Card title</h4>
        <p class="card-text">
          This is a wider card with supporting text below as a natural lead-in to additional new-admin.content. This content is a
          little bit longer.
        </p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
    <div class="card">
      <img class="card-img-top" src="{{asset('images/slider/05.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h4 class="card-title">Card title</h4>
        <p class="card-text">This card has supporting text below as a natural lead-in to additional new-admin.content.</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
    <div class="card">
      <img class="card-img-top" src="{{asset('images/slider/03.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h4 class="card-title">Card title</h4>
        <p class="card-text">
          This is a wider card with supporting text below as a natural lead-in to additional new-admin.content. This card has even
          longer content than the first to show that equal height action.
        </p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>

  <h6 class="my-3 text-muted">Grid Cards</h6>

  <div class="row row-cols-1 row-cols-md-3 mb-2">
    <div class="col">
      <div class="card h-100">
        <img class="card-img-top" src="{{asset('images/slider/03.jpg')}}" alt="Card image cap" />
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">
            This is a wider card with supporting text below as a natural lead-in to additional new-admin.content. This content is
            a little bit longer.
          </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img class="card-img-top" src="{{asset('images/slider/02.jpg')}}" alt="Card image cap" />
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">This card has supporting text below as a natural lead-in to additional new-admin.content.</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img class="card-img-top" src="{{asset('images/slider/01.jpg')}}" alt="Card image cap" />
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">
            This is a wider card with supporting text below as a natural lead-in to additional new-admin.content. This card has
            even longer content than the first to show that equal height action.
          </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Card layout -->
@endsection
