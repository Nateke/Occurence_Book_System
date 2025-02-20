
<div>
  <div class="card mb-4">
    <div class="card-body">
      <div class="user-avatar-section">
        <div class=" d-flex align-items-center flex-column">
          @if(Auth::user() && Auth::user()->profile_photo_url)
            <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/img.png') }}" alt class="h-auto rounded-circle">
          @else
            <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ asset('assets/img/img.png') }}" height="100" width="100" alt="User avatar" />
          @endif
          <div class="user-info text-center">
            <h4 class="mb-2">{{ auth()->user()->name }}</h4>
            @if(auth()->user()->roles->isNotEmpty())
              <p><i class="badge bg-label-secondary mt-1"></i> {{ auth()->user()->roles->first()->name }}</p>
            @endif
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
        <div class="d-flex align-items-start me-4 mt-3 gap-2">
          <span class="badge bg-label-primary p-2 rounded"><i class='ti ti-checkbox ti-sm'></i></span>
          <div>
            <p class="mb-0 fw-medium">1.23k</p>
            <small>Bookings Recorded</small>
          </div>
        </div>
        <div class="d-flex align-items-start mt-3 gap-2">
          <span class="badge bg-label-primary p-2 rounded"><i class='ti ti-briefcase ti-sm'></i></span>
          <div>
            <p class="mb-0 fw-medium">{{$bookingsCounts ?? 0}}</p>
            <small>Bookings Recorded</small>
          </div>
        </div>
      </div>
      <p class="mt-4 small text-uppercase text-muted">Details</p>
      <div class="info-container">
        <ul class="list-unstyled">
          <li class="mb-2">
            <span class="fw-medium me-1">Phone Number:</span>
            <span>{{ auth()->user()->phone_number }}</span>
          </li>
          <li class="mb-2 pt-1">
            <span class="fw-medium me-1">Email:</span>
            <span>{{ auth()->user()->email }}</span>
          </li>
          <li class="mb-2 pt-1">
            <span class="fw-medium me-1">Status:</span>
            <span class="badge bg-label-success">
                {{ auth()->user()->status }}
              </span>
          </li>
          <li class="mb-2 pt-1">
            <span class="fw-medium me-1">Role:</span>
            <span>
                @if(auth()->user()->roles->isNotEmpty())
                {{ auth()->user()->roles->first()->name }}
              @endif
              </span>
          </li>
          <li class="mb-2 pt-1">
            <span class="fw-medium me-1">County:</span>
            <span>{{ auth()->user()->county->name ?? '' }}</span>
          </li>
          <li class="mb-2 pt-1">
            <span class="fw-medium me-1">Sub-County:</span>
            <span>{{ auth()->user()->county->name ?? '' }}</span>
          </li>
          <li class="mb-2 pt-1">
            <span class="fw-medium me-1">Ward:</span>
            <span>{{ auth()->user()->ward->name ?? '' }}</span>
          </li>
          <li class="mb-2 pt-1">
            <span class="fw-medium me-1">Address:</span>
            <span>{{ auth()->user()->address ?? '' }}</span>
          </li>
          <li class="pt-1">
            <span class="fw-medium me-1">Country:</span>
            <span>{{ auth()->user()->country->name ?? ''}}</span>
          </li>
        </ul>
        <div class="d-flex justify-content-center">
          <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
          {{--            <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>--}}
        </div>
      </div>
    </div>
  </div>
</div>
