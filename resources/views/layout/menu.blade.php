<li class="nav-item">
    <a class="nav-link {{ Request::is('home') ? '':'collapsed' }}" href="{{ url('home') }}">
    
        <span>{{ $user->name }}</span>
    </a>
</li>

<!-- ADMIN -->
@if($user->level == 1)

<li class="nav-item">
  <a class="nav-link {{ Request::is('kriteria') ? '':'collapsed' }}"href="{{ url('kriteria') }}">
    <i class="fa-solid fa-clipboard"></i><span>Kriteria</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link {{ Request::is('balita') ? '':'collapsed' }}"href="{{ url('balita') }}">
    <i class="fa-solid fa-clipboard"></i><span>Balita</span>
  </a>
</li>


@endif