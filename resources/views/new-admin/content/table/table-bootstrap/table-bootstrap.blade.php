
@extends('layouts/contentLayoutMaster')

@section('title', 'Bootstrap Tables')

@section('content')
<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Table Basic</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Using the most basic table Leanne Grahamup, here’s how <code>.table</code>-based tables look in Bootstrap. You
          can use any example of below table for your table and it can be use with any type of bootstrap tables.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset("images/icons/react.svg")}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset("images/portrait/small/avatar-s-6.jpg")}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Basic Tables end -->

<!-- Dark Tables start -->
<div class="row" id="dark-table">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Dark Table</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          You can also invert the colors—with light text on dark backgrounds—with <code>.table-dark</code> class with
          <code>.table</code> class.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-dark">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button
                    type="button"
                    class="btn btn-sm text-white dropdown-toggle hide-arrow py-0"
                    data-bs-toggle="dropdown"
                  >
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button
                    type="button"
                    class="btn btn-sm text-white dropdown-toggle hide-arrow py-0"
                    data-bs-toggle="dropdown"
                  >
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button
                    type="button"
                    class="btn btn-sm text-white dropdown-toggle hide-arrow py-0"
                    data-bs-toggle="dropdown"
                  >
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button
                    type="button"
                    class="btn btn-sm text-white dropdown-toggle hide-arrow py-0"
                    data-bs-toggle="dropdown"
                  >
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Dark Tables end -->

<!-- Table head options start -->
<div class="row" id="table-head">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Table head options</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Similar to tables and dark tables, use the modifier classes
          <code class="highlighter-rouge">.table-dark</code> to make
          <code class="highlighter-rouge">&lt;thead&gt;</code>s appear dark.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead class="table-dark">
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset("images/icons/react.svg")}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-body mt-2">
        <p class="card-text">
          Use the modifier class <code class="highlighter-rouge">.table-light</code> to make
          <code class="highlighter-rouge">&lt;thead&gt;</code>s appear light.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset("images/icons/vuejs.svg")}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Table head options end -->

<!-- Striped rows start -->
<div class="row" id="table-striped">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Striped rows</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Use <code class="highlighter-rouge">.table-striped</code> to add zebra-striping to any table row within the
          <code class="highlighter-rouge">&lt;tbody&gt;</code>. This styling doesn't work in IE8 and below as
          <code>:nth-child</code> CSS selector isn't supported.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Striped rows end -->

<!-- Striped rows with inverse dark table start -->
<div class="row" id="table-striped-dark">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Striped rows with inverse dark</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Use <code>.table-dark</code> with <code>.table-striped</code> to add zebra-striping to any inverse table row
          within the <code>&lt;tbody&gt;</code>. This styling doesn't work in IE8 and below as
          <code>:nth-child</code> CSS selector isn't supported.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button
                    type="button"
                    class="btn btn-sm text-white dropdown-toggle hide-arrow py-0"
                    data-bs-toggle="dropdown"
                  >
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button
                    type="button"
                    class="btn btn-sm text-white dropdown-toggle hide-arrow py-0"
                    data-bs-toggle="dropdown"
                  >
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button
                    type="button"
                    class="btn btn-sm text-white dropdown-toggle hide-arrow py-0"
                    data-bs-toggle="dropdown"
                  >
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button
                    type="button"
                    class="btn btn-sm text-white dropdown-toggle hide-arrow py-0"
                    data-bs-toggle="dropdown"
                  >
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Striped rows with inverse dark table end -->

<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Bordered table</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Add <code>.table-bordered</code> for borders on all sides of the table and cells. For Inverse Dark Table, add
          <code>.table-dark</code> along with <code>.table-bordered</code>.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset("images/portrait/small/avatar-s-7.jpg")}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Bordered table end -->

<!-- Borderless table start -->
<div class="row" id="table-borderless">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Borderless Table</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Add <code>.table-borderless</code> for a table without borders. It can also be used on dark tables.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Borderless table end -->

<!-- Hoverable rows start -->
<div class="row" id="table-hover-row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Hoverable rows</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Add <code class="highlighter-rouge">.table-hover</code> to enable a hover state on table rows within a
          <code class="highlighter-rouge">&lt;tbody&gt;</code>.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Hoverable rows end -->

<!-- Small Table start -->
<div class="row" id="table-small">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Small Table</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Add <code class="highlighter-rouge">.table-sm</code> class with <code>.table</code> to display small size
          table.
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  alt="Angular"
                  width="18"
                  height="18"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  alt="React"
                  width="18"
                  height="18"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  alt="Vuejs"
                  width="18"
                  height="18"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  alt="Bootstrap"
                  width="18"
                  height="18"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="22"
                      width="22"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Small Table end -->

<!-- Contextual classes start -->
<div class="row" id="table-contextual">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Contextual classes</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Use contextual classes to color table rows or individual cells. Read full documnetation
          <a href="https://getbootstrap.com/docs/4.3/content/tables/IDcontextual-classes" target="_blank">here.</a>
        </p>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table-default">
              <td>
                <img
                  src="{{asset('images/icons/figma.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Figma"
                />
                <span class="fw-bold">Figma Project</span>
              </td>
              <td>Ronnie Shane</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-active">
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Project</span>
              </td>
              <td>Ronald Frest</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-primary">
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular Project</span>
              </td>
              <td>Peter Charls</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-secondary">
              <td>
                <img
                  src="{{asset('images/icons/vuejs.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Vuejs"
                />
                <span class="fw-bold">Vuejs Project</span>
              </td>
              <td>Jack Obes</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-secondary me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-success">
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap Project</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-success me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-danger">
              <td>
                <img
                  src="{{asset('images/icons/figma.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Figma"
                />
                <span class="fw-bold">Figma Project</span>
              </td>
              <td>Janne Ale</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-danger me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-warning">
              <td>
                <img
                  src="{{asset('images/icons/react.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="React"
                />
                <span class="fw-bold">React Custom</span>
              </td>
              <td>Ted Richer</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-warning me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-info">
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Latest Bootstrap</span>
              </td>
              <td>Perry Parker</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-light">
              <td>
                <img
                  src="{{asset('images/icons/angular.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Angular"
                />
                <span class="fw-bold">Angular UI</span>
              </td>
              <td>Ana Bell</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-primary me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-dark">
              <td>
                <img
                  src="{{asset('images/icons/bootstrap.svg')}}"
                  class="me-75"
                  height="20"
                  width="20"
                  alt="Bootstrap"
                />
                <span class="fw-bold">Bootstrap UI</span>
              </td>
              <td>Jerry Milton</td>
              <td>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Lilian Nenez"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar pull-up my-0"
                    title="Alberto Glotzbach"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      height="26"
                      width="26"
                    />
                  </div>
                </div>
              </td>
              <td><span class="badge rounded-pill badge-light-info me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                      <i data-feather="edit-2" ></i>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <i data-feather="trash" ></i>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Contextual classes end -->

<!-- Table without card start -->
<div class="row" id="table-without-card">
  <div class="col-12 my-2">
    <h5 class="mb-1">Table without card</h5>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Project</th>
            <th>Client</th>
            <th>Users</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <img
                src="{{asset('images/icons/angular.svg')}}"
                class="me-75"
                height="20"
                width="20"
                alt="Angular"
              />
              <span class="fw-bold">Angular Project</span>
            </td>
            <td>Peter Charls</td>
            <td>
              <div class="avatar-group">
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Lilian Nenez"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Alberto Glotzbach"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Alberto Glotzbach"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
              </div>
            </td>
            <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                  <i data-feather="more-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="#">
                    <i data-feather="edit-2" ></i>
                    <span>Edit</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <i data-feather="trash" ></i>
                    <span>Delete</span>
                  </a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <img src="{{asset('images/icons/react.svg')}}" class="me-75" height="20" width="20" alt="React" />
              <span class="fw-bold">React Project</span>
            </td>
            <td>Ronald Frest</td>
            <td>
              <div class="avatar-group">
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Lilian Nenez"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Alberto Glotzbach"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Alberto Glotzbach"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
              </div>
            </td>
            <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                  <i data-feather="more-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="#">
                    <i data-feather="edit-2" ></i>
                    <span>Edit</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <i data-feather="trash" ></i>
                    <span>Delete</span>
                  </a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <img src="{{asset('images/icons/vuejs.svg')}}" class="me-75" height="20" width="20" alt="Vuejs" />
              <span class="fw-bold">Vuejs Project</span>
            </td>
            <td>Jack Obes</td>
            <td>
              <div class="avatar-group">
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Lilian Nenez"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Alberto Glotzbach"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Alberto Glotzbach"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
              </div>
            </td>
            <td><span class="badge rounded-pill badge-light-info me-1">Scheduled</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                  <i data-feather="more-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="#">
                    <i data-feather="edit-2" ></i>
                    <span>Edit</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <i data-feather="trash" ></i>
                    <span>Delete</span>
                  </a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <img
                src="{{asset('images/icons/bootstrap.svg')}}"
                class="me-75"
                height="20"
                width="20"
                alt="Bootstrap"
              />
              <span class="fw-bold">Bootstrap Project</span>
            </td>
            <td>Jerry Milton</td>
            <td>
              <div class="avatar-group">
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Lilian Nenez"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Alberto Glotzbach"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar pull-up my-0"
                  title="Alberto Glotzbach"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                    alt="Avatar"
                    height="26"
                    width="26"
                  />
                </div>
              </div>
            </td>
            <td><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                  <i data-feather="more-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="#">
                    <i data-feather="edit-2" ></i>
                    <span>Edit</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <i data-feather="trash" ></i>
                    <span>Delete</span>
                  </a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Table without card End -->

<!-- Responsive tables start -->
<div class="row" id="table-responsive">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Responsive tables</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          Responsive tables allow tables to be scrolled horizontally with ease. Make any table responsive across all
          viewports by adding <code class="highlighter-rouge">.table-responsive</code> class on
          <code class="highlighter-rouge">.table</code>. Or, pick a maximum breakpoint with which to have a responsive
          table up to by adding <code class="highlighter-rouge"> .table-responsive{-sm|-md|-lg|-xl}</code>. Read full
          documentation
          <a href="https://getbootstrap.com/docs/4.3/content/tables/#responsive-tables" target="_blank">here.</a>
        </p>
        <div class="alert alert-info">
          <div class="alert-body">
            <h4 class="text-warning">Vertical clipping/truncation</h4>
            <p>
              Responsive tables make use of <code class="highlighter-rouge">overflow-y: hidden</code>, which clips off
              any content that goes beyond the bottom or top edges of the table. In particular, this can clip off
              dropdown menus and other third-party widgets.
            </p>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table mb-0">
          <thead>
            <tr>
              <th scope="col" class="text-nowrap">#</th>
              <th scope="col" class="text-nowrap">Heading 1</th>
              <th scope="col" class="text-nowrap">Heading 2</th>
              <th scope="col" class="text-nowrap">Heading 3</th>
              <th scope="col" class="text-nowrap">Heading 4</th>
              <th scope="col" class="text-nowrap">Heading 5</th>
              <th scope="col" class="text-nowrap">Heading 6</th>
              <th scope="col" class="text-nowrap">Heading 7</th>
              <th scope="col" class="text-nowrap">Heading 8</th>
              <th scope="col" class="text-nowrap">Heading 9</th>
              <th scope="col" class="text-nowrap">Heading 10</th>
              <th scope="col" class="text-nowrap">Heading 11</th>
              <th scope="col" class="text-nowrap">Heading 12</th>
              <th scope="col" class="text-nowrap">Heading 13</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-nowrap">1</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
              <td class="text-nowrap">Table cell</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
              <td>Table cell</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Responsive tables end -->
@endsection
