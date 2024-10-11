@extends('layouts.app')
@section('user-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Assign Permission</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Assign Permission</h5>
                                <label class="checkbox-inline">
                                    <span style="font-size: 20px; font-weight: 600; padding-right: 10px;">Select All:</span>
                                    <input type="checkbox" id="checkAll" {{ $hasAllPermisison ? 'checked' : '' }}>
                                </label>
                            </div>
                            <div class="col-md-6 text-right">
                                User: <span style="color: red">{{ $user->full_name }}</span>
                            </div>
                        </div>

                        <form action="{{ route('permissions.assign') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="row">
                                @foreach ($groupByPermission as $key => $permissions)
                                    <div class="col pb-3">
                                        <h6 style="color: black; font-size: 18px;">
                                            <h3>{{ $key }}</h3>
                                        </h6>
                                        @foreach ($permissions as $permission)
                                            @foreach ($permission as $value)
                                                <p><input type="checkbox" class="permissionCheckBox"
                                                        {{ in_array($value->id, getUserPermissionsIds($user->id)) ? 'checked' : '' }}
                                                        name="permissions[]" value="{{ $value->id }}">
                                                    {{ $value->name }}</p>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    @if ($loop->iteration % 4 == 0)
                            </div>
                            <div class="row">
                                @endif
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn save-btn" value="Assign Permission">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            var checkboxes = document.getElementsByClassName('permissionCheckBox');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
            }
        });


        // Get all checkboxes with class "checkbox"
        const checkboxes = document.querySelectorAll('.permissionCheckBox');

        // Function to check if any checkbox is unchecked
        function isAnyCheckboxUnchecked() {
            for (let i = 0; i < checkboxes.length; i++) {
                if (!checkboxes[i].checked) {
                    return true; // At least one checkbox is unchecked
                }
            }
            return false; // All checkboxes are checked
        }

        $('.permissionCheckBox').change(function() {
            if (isAnyCheckboxUnchecked()) {
                $('#checkAll').removeAttr('checked');
            } else {
                $('#checkAll').prop("checked", true);
            }
        });
    </script>
@endsection
