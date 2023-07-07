<div class="bg-white shadow-sm rounded-sm p-4 mb-2">
  <ul class="nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link {{ request()->is('panel/users/*') ? 'active' : '' }}" aria-current="page" href="{{route('panel.users.show',$user->id)}}">مشاهده اطلاعات</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('panel/address/*') ? 'active' : '' }}" href="{{route('panel.address.show',$user->id)}}">آدرس ها</a>
    </li>
  </ul>
</div>
