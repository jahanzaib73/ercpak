@extends('layouts/contentLayoutMaster')

@section('title', 'Notifications')

@section('content')
<div class="row">
  <div class="col-12">
    <ul class="nav nav-pills mb-2">
      <!-- Account -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-account')}}">
          <i data-feather="user" class="font-medium-3 me-50"></i>
          <span class="fw-bold">{{ __(Account) }}</span>
        </a>
      </li>
      <!-- security -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-security')}}">
          <i data-feather="lock" class="font-medium-3 me-50"></i>
          <span class="fw-bold">{{ __(Security) }}</span>
        </a>
      </li>
      <!-- billing and plans -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-billing')}}">
          <i data-feather="bookmark" class="font-medium-3 me-50"></i>
          <span class="fw-bold">{{ __(Billings) }} &amp; {{ __(Plans) }}</span>
        </a>
      </li>
      <!-- notification -->
      <li class="nav-item">
        <a class="nav-link active" href="{{asset('page/account-settings-notifications')}}">
          <i data-feather="bell" class="font-medium-3 me-50"></i>
          <span class="fw-bold">{{ __(Notifications) }}</span>
        </a>
      </li>
      <!-- connection -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-connections')}}">
          <i data-feather="link" class="font-medium-3 me-50"></i>
          <span class="fw-bold">{{ __(Connections) }}</span>
        </a>
      </li>
    </ul>

    <!-- notifications -->

    <div class="card">
      <div class="card-header border-bottom">
        <h4 class="card-title">{{ __(Notifications) }}</h4>
      </div>
      <div class="card-body pt-2">
        <h5 class="mb-0">
          We need permission from your browser to show notifications. <strong>Request permission</strong>
        </h5>
      </div>
      <div class="table-responsive">
        <table class="table text-nowrap text-center border-bottom">
          <thead>
            <tr>
              <th class="text-start">{{ __(Type) }}</th>
              <th>✉️ {{ __(Email)}}</th>
              <th>🖥 {{ __(Browser) }}</th>
              <th>👩🏻‍💻 {{ __(App) }}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-start">{{ __(New for you)}}</td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="" />
                </div>
              </td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck2" />
                </div>
              </td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                </div>
              </td>
            </tr>
            <tr>
              <td class="text-start">Account activity</td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck4" />
                </div>
              </td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck5" checked="" />
                </div>
              </td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck6" checked="" />
                </div>
              </td>
            </tr>
            <tr>
              <td class="text-start">A new browser used to sign in</td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck7" checked="" />
                </div>
              </td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck8" checked="" />
                </div>
              </td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck9" checked="" />
                </div>
              </td>
            </tr>
            <tr>
              <td class="text-start">A new device is linked</td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck10" />
                </div>
              </td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck11" checked="" />
                </div>
              </td>
              <td>
                <div class="form-check d-flex justify-content-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck12" />
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-body mt-50">
        <form onsubmit="return false">
          <div class="row gy-2">
            <div class="col-md-6">
              <h5 class="mb-1">When should we send you notifications?</h5>
              <select id="sendNotification" class="form-select" name="sendNotification">
                <option>Full Access Always</option>
                <option>Only when I'm online</option>
                <option>Never</option>
              </select>
            </div>
            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-1">Save changes</button>
              <button type="reset" class="btn btn-outline-secondary">Discard</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!--/ notifications -->
  </div>
</div>
@endsection
