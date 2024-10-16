@extends('layouts/contentLayoutMaster')

@section('title', 'Collapse')

@section('content')
<!-- Collapse start -->
<section id="collapsible">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Basic</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Toggle the visibility of content across your project with a few classes and our JavaScript plugins.
          </p>
          <p class="mb-2 demo-inline-spacing">
            <a
              class="btn btn-primary me-1"
              data-bs-toggle="collapse"
              href="#collapseExample"
              role="button"
              aria-expanded="false"
              aria-controls="collapseExample"
            >
              Link with href
            </a>
            <button
              class="btn btn-primary me-1"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseExample"
              aria-expanded="false"
              aria-controls="collapseExample"
            >
              Button with data-bs-target
            </button>
          </p>
          <div class="collapse" id="collapseExample">
            <div class="d-flex p-1 border">
              <img src="{{asset('images/slider/04.jpg')}}" alt="collapse-image" height="125" class="me-2" />
              <span>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                software like Aldus PageMaker including versions of Lorem Ipsum.It is a long established fact that a
                reader will be distracted by the readable content of a page when looking at its layout. The point of
                using Lorem Ipsum is that it has a more-or-less normal distribution of letters.
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Collapse end -->

<!-- Collapse start -->
<section id="multi-collapsible">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Multiple targets</h4>
        </div>
        <div class="card-body">
          <p class="card-text">Show and hide multiple elements by referencing them with a selector.</p>

          <p class="mb-2 demo-inline-spacing">
            <a
              class="btn btn-primary me-1"
              data-bs-toggle="collapse"
              href="#multiCollapseExample1"
              role="button"
              aria-expanded="false"
              aria-controls="multiCollapseExample1"
              >Toggle first element</a
            >
            <button
              class="btn btn-primary me-1"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#multiCollapseExample2"
              aria-expanded="false"
              aria-controls="multiCollapseExample2"
            >
              Toggle second element
            </button>
            <button
              class="btn btn-primary me-1"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target=".multi-collapse"
              aria-expanded="false"
              aria-controls="multiCollapseExample1 multiCollapseExample2"
            >
              Toggle both elements
            </button>
          </p>
          <div class="row">
            <div class="col-lg">
              <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="d-flex p-1 border">
                  <img src="{{asset('images/slider/06.jpg')}}" alt="collapse-image" height="125" class="me-2" />
                  <span>
                    All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making
                    this the first true generator on the Internet. It uses a dictionary of over 200 Latin words,
                    combined with a handful of model sentence structures, to generate Lorem Ipsum which looks
                    reasonable.
                  </span>
                </div>
              </div>
            </div>
            <div class="col-lg">
              <div class="collapse multi-collapse mt-lg-0 mt-1" id="multiCollapseExample2">
                <div class="d-flex p-1 border">
                  <img src="{{asset('images/slider/08.jpg')}}" alt="collapse-image" height="125" class="me-2" />
                  <span>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form, by injected humour, or randomised words which don't look even slightly
                    believable. If you are going to use a passage of Lorem Ipsum.It is a long established fact that a
                    reader new-admin.content.
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Collapse end -->

<!-- Horizontal Collapse start-->
<section id="horizontalCollapse">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Horizontal Collapse</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            The collapse plugin also supports horizontal collapsing. Add the .collapse-horizontal modifier class to
            transition the width instead of height and set a width on the immediate child element.
          </p>

          <button
            class="btn btn-primary"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseWidthExample"
            aria-expanded="false"
            aria-controls="collapseWidthExample"
          >
            Toggle width collapse
          </button>
          <div class="height-150 mt-2">
            <div class="collapse collapse-horizontal show" id="collapseWidthExample">
              <div class="d-flex width-300 border p-1">
                <img
                  src="{{asset('images/slider/08.jpg')}}"
                  alt="collapse-image"
                  width="100"
                  height="100"
                  class="me-1"
                />
                <div class="flex-grow-1">
                  This is some content from a media component. You can replace this with any content and adjust it as
                  needed.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Horizontal Collapse end-->
@endsection
