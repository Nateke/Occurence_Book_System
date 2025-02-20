@extends('layouts/layoutMaster')

@section('title', 'Users List ')

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
          <i class="fas fa-add px-2"></i> Add User
        </button>
      </div>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddObUserLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="pt-0" action="{{route('users.store') }}" method="POST">
              @csrf
          <div class="mb-3">
            <label class="form-label" for="add-user-fullname">Full Name</label>
            <input type="text" class="form-control" id="add-user-fullname" placeholder="User Name" name="name" aria-label="John"  required value="{{ old('name') }}"/>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-email">Email</label>
            <input type="email" id="add-user-email" class="form-control" placeholder="john@example.com" aria-label="john@example.com" name="email" required value="{{ old('email') }}" />
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-contact">Phone Number</label>
            <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+254 (07) 12345678" aria-label="" name="phone_number" required value="{{ old('phone_number') }}" />
            @error('phone_number')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-contact">ID Number/PASSPORT</label>
            <input type="number" id="add-user-id" class="form-control" placeholder="2345654374" aria-label="ID/PASSPORT" name="id_no" required value="{{ old('id_no') }}" />
            @error('id_no')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="gender">Gender</label>
            <select id="gender" class="form-select" name="gender" required>
              <option value="" @if(old('gender') == '') selected @endif>Select Gender</option>
              <option value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
              <option value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
              <option value="Other" @if(old('gender') == 'Other') selected @endif>Other</option>
            </select>
            @error('gender')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="status">Status</label>
            <select id="status" class="form-select" name="status">
              <option value="" @if(old('status') == '') selected @endif>Select Status</option>
              <option value="active" @if(old('status') == 'active') selected @endif>Active</option>
              <option value="suspended" @if(old('status') == 'suspended') selected @endif>Inactive</option>
            </select>
            @error('status')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="station">Station</label>
            <select id="station" class="form-select" name="station_id">
              <option value="" @if(old('station_id') == '') selected @endif>Select User Posted Station</option>
              @foreach($stations as $station)
                <option value="{{ $station->id }}" @if(old('station_id') == $station->id) selected @endif>{{ $station->station_name }}</option>
              @endforeach
            </select>
            @error('station_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="role">Roles</label>
            <select id="role" class="form-select" name="role_id" required onchange="toggleOfficerFields(this.value)">
              <option value="" @if(old('role_id') == '') selected @endif>Select Role</option>
              @foreach($roles as $role)
                <option value="{{ $role->name }}" @if(old('role_id') == $role->name) selected @endif>{{ $role->name }}</option>
              @endforeach
            </select>
            @error('role_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3" id="officerFields" style="display: none;">
            <label class="form-label" for="officerRank">Officer Rank</label>
            <input type="text" class="form-control" id="officerRank" name="rank" value="{{ old('rank') }}">
          </div>

          <div class="mb-3" id="badgeFields" style="display: none;">
            <label class="form-label" for="badgeNumber">Badge Number</label>
            <input type="text" class="form-control" id="badgeNumber" name="badge_number" value="{{ old('badge_number') }}">
            @error('badge_number')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label" for="county">County</label>
            <select id="county" name="county" class=" form-select" required >
              <option value="" @if(old('county') == '') selected @endif>Select County</option>
              @foreach($counties as $county)
                <option value="{{ $county->id }}" @if(old('county') == $county->name) selected @endif>{{ $county->name }}</option>
              @endforeach
            </select>
            @error('county')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="subcounty">Sub-County</label>
            <select id="subcounty" class="form-select" name="subcounty_id" required>
              <option value="">Select Sub-County</option>
            </select>
            @error('subcounty')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="ward">Ward</label>
            <select id="ward" name="ward" class="select2 form-select"  required>
              <option value="">Select</option>
            </select>
            @error('ward')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
      </div>
    </div>
    </div>
    <div class="card">
      <livewire:tabs-component/>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
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

        function toggleOfficerFields(selectedRole) {
        var officerFields = document.getElementById('officerFields');
          var badgeFields = document.getElementById('badgeFields');
      if (selectedRole === 'officer' || selectedRole === 'Officer' || selectedRole === 'OFFICER') {
        officerFields.style.display = 'block';
            badgeFields.style.display = 'block';
          } else {
            officerFields.style.display = 'none';
            badgeFields.style.display = 'none';
          }
      }
    </script>
@endsection
