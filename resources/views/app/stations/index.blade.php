@extends('layouts.layoutMaster')

@section('title', 'Stations List ')

@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/@form-validation/form-validation.scss',
    ])
@endsection

@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/moment/moment.js',
      'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/@form-validation/popular.js',
      'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
      'resources/assets/vendor/libs/@form-validation/auto-focus.js',
      'resources/assets/vendor/libs/cleavejs/cleave.js',
      'resources/assets/vendor/libs/cleavejs/cleave-phone.js'
    ])
@endsection

@section('page-script')
    @vite('resources/assets/js/app-user-list.js')

@endsection

@section('content')
  <div>
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-primary ms-auto my-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">
        <i class="fas fa-add px-2"></i> Add Station
      </button>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Station</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" id="addNewStationForm" action="{{ route('stations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label" for="name">Station Name</label>
          <input type="text" class="form-control" id="name" placeholder="Kamkunji Police Station" name="station_name" aria-label="Kamkuji Police Station" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="county">County</label>
          <select id="county" class="form-select" name="county_id">
            <option value="">Select County</option>
            @foreach($counties as $county)
              <option value="{{ $county->id }}">{{ $county->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label" for="subcounty">Sub-County</label>
          <select id="subcounty" class=" form-select" name="subcounty_id">
            <option value="">Select Sub-County</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label" for="ward"> Ward </label>
          <select id="ward" class="select2 form-select" name="ward_id">
            <option value="">Select Ward</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="location">Location</label>
          <input type="text" id="location" name="location" class="form-control" placeholder="location" aria-label="location" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="sublocation">Sub-Location</label>
          <input type="text" id="sublocation" name="sublocation" class="form-control" placeholder="sublocation" aria-label="sublocation" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="address">Address</label>
          <input type="text" id="address" name="address" class="form-control" placeholder="address" aria-label="address"  />
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
  </div>
    <div class="card ">
        <livewire:tables.stations/>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
{{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-47zltbR5t0u5JP07I/FL9l9CIrJ84P2a6QFyNX8onp+Wr9gW+prX5KpZd3X5aEzhGfxO2dFJAx7L1UwP4a9Cdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-ZMiCrZKHpfbX7vEa4X+k4Q4HRhuL86N1k7aJ6KjRzCazbQhY9fB8YdVpU9bK/sHc3d0D1A7usgOB+khM7fMd0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
{{--  <script>--}}
{{--    $('.select2').select2();--}}
{{--    $('.select2-container').each(function () {--}}
{{--      var container = $(this);--}}
{{--      container.find('.select2-search__field').after('<input type="text" class="second-search-input" placeholder="Second Search">');--}}
{{--    });--}}
{{--    $(document).on('click', function (e) {--}}
{{--      if (!$(e.target).closest('.select2-container').length) {--}}
{{--        $('.select2').select2('close');--}}
{{--      }--}}
{{--    });--}}
{{--  </script>--}}
  <script>
    $(document).ready(function () {
      var countySelect = $('#county');
      var subcountySelect = $('#subcounty');
      var wardSelect = $('#ward');

      countySelect.change(function () {
        var selectedCountyId = countySelect.val();
        $.get('subcounties/list/' + selectedCountyId)
          .done(function (data) {
            subcountySelect.html('<option value="">Select Sub-County</option>');
            wardSelect.html('<option value="">Select Ward</option>');

            $.each(data, function (index, subcounty) {
              subcountySelect.append('<option value="' + subcounty.id + '">' + subcounty.subcounty_name + '</option>');
            });
          })
          .fail(function (error) {
            console.error('Error:', error);
          });
      });

      subcountySelect.change(function () {
        var selectedSubcountyId = subcountySelect.val();

        $.get('wards/list/' + selectedSubcountyId)
          .done(function (data) {
            wardSelect.html('<option value="">Select Ward</option>');

            $.each(data, function (index, ward) {
              wardSelect.append('<option value="' + ward.id + '">' + ward.name + '</option>');
            });
          })
          .fail(function (error) {
            console.error('Error:', error);
          });
      });
    });


  </script>
@endsection
