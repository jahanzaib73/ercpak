@extends('layouts/contentLayoutMaster')

@section('title', 'API Key')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<section id="ApiKeyPage">
  <!-- create API key -->
  <div class="card">
    <div class="card-header pb-0">
      <h4 class="card-title">Create an API Key</h4>
    </div>
    <div class="row">
      <div class="col-md-5 order-md-0 order-1">
        <div class="card-body">
          <!-- form -->
          <form id="createApiForm" onsubmit="return false">
            <div class="mb-2">
              <label for="ApiKeyType" class="form-label">Choose the Api key type you want to create</label>
              <select class="select2 form-select" id="ApiKeyType">
                <option value="">Choose Key Type</option>
                <option value="full">Full Control</option>
                <option value="modify">Modify</option>
                <option value="read-execute">Read &amp; Execute</option>
                <option value="folders">List Folder Contents</option>
                <option value="read">Read Only</option>
                <option value="read-write">Read &amp; Write</option>
              </select>
            </div>

            <div class="mb-2">
              <label for="nameApiKey" class="form-label">Name the API key</label>
              <input
                class="form-control"
                type="text"
                name="apiKeyName"
                placeholder="Server Key 1"
                id="nameApiKey"
                data-msg="Please enter API key name"
              />
            </div>

            <button type="submit" class="btn btn-primary w-100">Create Key</button>
          </form>
        </div>
      </div>
      <div class="col-md-7 order-md-1 order-0">
        <div class="text-center">
          <img
            class="img-fluid text-center"
            src="{{asset('images/illustration/pricing-Illustration.svg')}}"
            alt="illustration"
            width="310"
          />
        </div>
      </div>
    </div>
  </div>

  <!-- api key list -->
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">API Key List & Access</h4>
    </div>
    <div class="card-body">
      <p class="card-text">
        An API key is a simple encrypted string that identifies an application without any principal. They are useful
        for accessing public data anonymously, and are used to associate API requests with your project for quota and
        billing.
      </p>

      <div class="row gy-2">
        <div class="col-12">
          <div class="bg-light-secondary position-relative rounded p-2">
            <div class="dropdown dropstart btn-pinned">
              <a
                class="btn btn-icon rounded-circle hide-arrow dropdown-toggle p-0"
                href="javascript:void(0)"
                id="dropdownMenuButton1"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i data-feather="more-vertical" class="font-medium-4"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i data-feather="edit-2" ></i><span>Edit</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i data-feather="trash-2" class="me-50"></i><span>Delete</span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="d-flex align-items-center flex-wrap">
              <h4 class="mb-1 me-1">Server Key 1</h4>
              <span class="badge badge-light-primary mb-1">Full Access</span>
            </div>
            <h6 class="d-flex align-items-center fw-bolder">
              <span class="me-50">23eaf7f0-f4f7-495e-8b86-fad3261282ac</span>
              <span><i data-feather="copy" class="font-medium-4 cursor-pointer"></i></span>
            </h6>
            <span>Created on 28 Apr 2020, 18:20 GTM+4:10</span>
          </div>
        </div>
        <div class="col-12">
          <div class="bg-light-secondary position-relative rounded p-2">
            <div class="dropdown dropstart btn-pinned">
              <a
                class="btn btn-icon rounded-circle hide-arrow dropdown-toggle p-0"
                href="javascript:void(0)"
                id="dropdownMenuButton2"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i data-feather="more-vertical" class="font-medium-4"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i data-feather="edit-2" ></i><span>Edit</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i data-feather="trash-2" class="me-50"></i><span>Delete</span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="d-flex align-items-center flex-wrap">
              <h4 class="mb-1 me-1">Server Key 2</h4>
              <span class="badge badge-light-primary mb-1">Read Only</span>
            </div>
            <h6 class="d-flex align-items-center fw-bolder">
              <span class="me-50">bb98e571-a2e2-4de8-90a9-2e231b5e99</span>
              <span><i data-feather="copy" class="font-medium-4 cursor-pointer"></i></span>
            </h6>
            <span>Created on 12 Feb 2020, 10:30 GTM+2:30</span>
          </div>
        </div>
        <div class="col-12">
          <div class="bg-light-secondary position-relative rounded p-2">
            <div class="dropdown dropstart btn-pinned">
              <a
                class="btn btn-icon rounded-circle hide-arrow dropdown-toggle p-0"
                href="javascript:void(0)"
                id="dropdownMenuButton3"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i data-feather="more-vertical" class="font-medium-4"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i data-feather="edit-2" ></i><span>Edit</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i data-feather="trash-2" class="me-50"></i><span>Delete</span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="d-flex align-items-center flex-wrap">
              <h4 class="mb-1 me-1">Server Key 3</h4>
              <span class="badge badge-light-primary mb-1">Full Access</span>
            </div>
            <h6 class="d-flex align-items-center fw-bolder">
              <span class="me-50">2e915e59-3105-47f2-8838-6e46bf83b711</span>
              <span><i data-feather="copy" class="font-medium-4 cursor-pointer"></i></span>
            </h6>
            <span>Created on 28 Apr 2020, 12:21 GTM+4:10</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/page-api-key.js')) }}"></script>
@endsection
