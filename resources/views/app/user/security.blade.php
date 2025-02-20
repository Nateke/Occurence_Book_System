@extends('layouts/layoutMaster')

@section('title', 'Security and Password- Pages')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
  'resources/assets/vendor/libs/cleavejs/cleave.js',
  'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/modal-edit-user.js',
  'resources/assets/js/modal-enable-otp.js',
  'resources/assets/js/app-user-view.js',
  'resources/assets/js/app-user-view-security.js'
])
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">User / View /</span> Security
</h4>
<div class="row">
  <!-- User Sidebar -->
  <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <x-user-account-details />
    <!-- /User Card -->
  </div>
  <!--/ User Sidebar -->


  <!-- User Content -->
  <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
    <!-- User Pills -->
    <ul class="nav nav-pills flex-column flex-md-row mb-4">
      <li class="nav-item"><a class="nav-link" href="{{route('profile')}}"><i class="ti ti-user-check me-1 ti-xs"></i>Account</a></li>
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="ti ti-lock me-1 ti-xs"></i>Security and Password</a></li>
{{--      <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/billing')}}"><i class="ti ti-currency-dollar me-1 ti-xs"></i>Billing & Plans</a></li>--}}
{{--      <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/notifications')}}"><i class="ti ti-bell me-1 ti-xs"></i>Notifications</a></li>--}}
{{--      <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/connections')}}"><i class="ti ti-link me-1 ti-xs"></i>Connections</a></li>--}}
    </ul>
    <!--/ User Pills -->

    <!-- Change Password -->
    <div class="card mb-4">
      <h5 class="card-header">Change Password</h5>
      <div class="card-body">
        <form id="formChangePassword" method="POST" onsubmit="return false">
          <div class="alert alert-warning" role="alert">
            <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
            <span>Minimum 8 characters long, uppercase & symbol</span>
          </div>
          <div class="row">
            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
              <label class="form-label" for="newPassword">New Password</label>
              <div class="input-group input-group-merge">
                <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>

            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
              <label class="form-label" for="confirmPassword">Confirm New Password</label>
              <div class="input-group input-group-merge">
                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-primary me-2">Change Password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!--/ Change Password -->

    <!-- Two-steps verification -->
    <div class="card mb-4">
      <h5 class="card-header pb-2">Two-steps verification</h5>
      <div class="card-body">
        <span>Keep your account secure with authentication step.</span>
        <h6 class="mt-3 mb-2">SMS</h6>
        <div class="d-flex justify-content-between border-bottom mb-3 pb-2">
          <span>{{ auth()->user()->phone_number ?? '' }}</span>
          <div class="action-icons">
            <a href="javascript:;" class="text-body me-1" data-bs-target="#enableOTP" data-bs-toggle="modal"><i class="ti ti-edit ti-sm"></i></a>
            <a href="javascript:;" class="text-body"><i class="ti ti-trash ti-sm"></i></a>
          </div>
        </div>
        <p class="mb-0">Two-factor authentication adds an additional layer of security to your account by requiring more than just a password to log in.
{{--          <a href="javascript:void(0);" class="text-body">Learn more.</a>--}}
        </p>
      </div>
    </div>
    <!--/ Two-steps verification -->

    <!-- Recent Devices -->
{{--    <div class="card mb-4">--}}
{{--      <h5 class="card-header">Recent Devices</h5>--}}
{{--      <div class="table-responsive">--}}
{{--        <table class="table border-top">--}}
{{--          <thead>--}}
{{--            <tr>--}}
{{--              <th class="text-truncate">Browser</th>--}}
{{--              <th class="text-truncate">Device</th>--}}
{{--              <th class="text-truncate">Location</th>--}}
{{--              <th class="text-truncate">Recent Activities</th>--}}
{{--            </tr>--}}
{{--          </thead>--}}
{{--          <tbody>--}}
{{--            <tr>--}}
{{--              <td class="text-truncate"><i class='ti ti-brand-windows text-info ti-xs me-2'></i> <span class="fw-medium">Chrome on Windows</span></td>--}}
{{--              <td class="text-truncate">HP Spectre 360</td>--}}
{{--              <td class="text-truncate">Switzerland</td>--}}
{{--              <td class="text-truncate">10, July 2021 20:07</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--              <td class="text-truncate"><i class='ti ti-device-mobile text-danger ti-xs me-2'></i> <span class="fw-medium">Chrome on iPhone</span></td>--}}
{{--              <td class="text-truncate">iPhone 12x</td>--}}
{{--              <td class="text-truncate">Australia</td>--}}
{{--              <td class="text-truncate">13, July 2021 10:10</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--              <td class="text-truncate"><i class='ti ti-brand-android text-success ti-xs me-2'></i> <span class="fw-medium">Chrome on Android</span></td>--}}
{{--              <td class="text-truncate">Oneplus 9 Pro</td>--}}
{{--              <td class="text-truncate">Dubai</td>--}}
{{--              <td class="text-truncate">14, July 2021 15:15</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--              <td class="text-truncate"><i class='ti ti-brand-apple ti-xs me-2'></i> <span class="fw-medium">Chrome on MacOS</span></td>--}}
{{--              <td class="text-truncate">Apple iMac</td>--}}
{{--              <td class="text-truncate">India</td>--}}
{{--              <td class="text-truncate">16, July 2021 16:17</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--              <td class="text-truncate"><i class='ti ti-brand-windows text-info ti-xs me-2'></i> <span class="fw-medium">Chrome on Windows</span></td>--}}
{{--              <td class="text-truncate">HP Spectre 360</td>--}}
{{--              <td class="text-truncate">Switzerland</td>--}}
{{--              <td class="text-truncate">20, July 2021 21:01</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--              <td class="text-truncate border-bottom-0"><i class='ti ti-brand-android text-success ti-xs me-2'></i> <span class="fw-medium">Chrome on Android</span></td>--}}
{{--              <td class="text-truncate border-bottom-0">Oneplus 9 Pro</td>--}}
{{--              <td class="text-truncate border-bottom-0">Dubai</td>--}}
{{--              <td class="text-truncate border-bottom-0">21, July 2021 12:22</td>--}}
{{--            </tr>--}}
{{--          </tbody>--}}
{{--        </table>--}}
{{--      </div>--}}
{{--    </div>--}}
    <!--/ Recent Devices -->
  </div>
  <!--/ User Content -->
</div>

<!-- Modals -->
@include('_partials/_modals/modal-edit-user')
@include('_partials/_modals/modal-enable-otp')
@include('_partials/_modals/modal-upgrade-plan')
<!-- /Modals -->

@endsection
