@extends('layouts.layoutMaster')

@section('title', 'Wards/Areas List ')

@section('vendor-style')
  @vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss'
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

{{--  <div class="card">--}}
{{--    <livewire:tables.areas/>--}}
{{--  </div>--}}
  <div class="row">
    <div class="col-md-9">
      <livewire:tables.areas/>
    </div>
    <div class="col-md-3 my-5 py-5">
      <div class="card card-default"  style="background: white">
        <div class="card-body">
          <div class="card-body">
            <h4 class="card-title">Add a Ward </h4>
            <form method="POST" action="{{ route('wards.store') }}" style="gap: 20px;">
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="card"  style="background: white">
                    <div class="card-body">
                      <div class="row">
                        <div class="mb-2 col-md-12 col-12">
                          <div class="form-group">
                            <label for="first-name-column">Ward</label>
                            <input type="text" id="first-name-column" class="form-control"
                                   placeholder="Ward Name" name="name" required />
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="form-group">
                            <label for="select-country">Sub-County</label>
                            <select class="form-control select2" id="select-country"
                                    name="subcounty" required>
                              <option value="">Select Sub-County</option>
                              @foreach ($subcounties as $subcounty)
                                <option value="{{ $subcounty->id }}">{{ $subcounty->subcounty_name }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-2 col-12 d-flex flex-sm-row flex-column" style="gap: 20px;">
                <button type="submit" class="btn btn-md btn-primary mb-1 mr-0 btn mb-sm-0 mr-sm-1 my-2 mx-5" > Add Ward</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
