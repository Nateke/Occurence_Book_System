<div>
<div>
  <div class="px-1 mx-5">
    <ul class="nav nav-tabs px-5">
      <li class="nav-item">
        <a class="nav-link  @if($activeTab === 'users') active @endif" wire:click="$set('activeTab', 'users')" href="#">View All Users</a>
      </li>
      <li class=" px-1 nav-item">
        <a class="nav-link @if($activeTab === 'officers') active @endif" wire:click="$set('activeTab', 'officers')" href="#">View All Officers</a>
      </li>
    </ul>
  </div>

    <div class="tab-content px-0 mx-0">
      <div class="tab-pane fade @if($activeTab === 'users') show active @endif">
        <livewire:tables.users />
      </div>
      <div class="tab-pane fade @if($activeTab === 'officers') show active @endif">
        <livewire:tables.officers />
      </div>
    </div>
</div>
</div>
