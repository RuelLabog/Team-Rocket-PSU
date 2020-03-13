<div class="row">
    <div class="container">

        <ul id="slide-out" class="sidenav sidenav-fixed">
            <li><div class="user-view">
              <div class="background">
                <img src="../public/images/background.png">
              </div>
              <a href="#user"><img class="circle" src="../public/images/rocket.jpg"></a>
              <a href="#name"><span class="white-text name" style="font-size: 150%;"><b>Team Rocket</b></span></a>
              <a href="https://github.com/RuelLabog/Team-Rocket-PSU"><span class="white-text email">https://github.com/RuelLabog/Team-Rocket-PSU</span></a>
            </div></li>
            <li><a href="{{url('pairing_page')}}" class="waves-effect"><i class="material-icons">favorite</i>Pairing</a></li>
          <li><a href="{{url('subscribersA')}}" class="waves-effect"><i class="material-icons">person</i>Subscribers</a></li>
          <li><a href="{{url('operators')}}" class="waves-effect"><i class="material-icons">headset_mic</i>Operators</a></li>
          <li><a href="{{url('services')}}" class="waves-effect" ><i class="material-icons">laptop_mac</i>Services</a></li>
          <li><a href="{{url('persona')}}" class="waves-effect" ><i class="material-icons">chat</i>Personas</a></li>
          <li><a onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
            class="waves-effect" ><i class="material-icons">power_settings_new</i>{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form></li>
          </ul>

       <!-- Modal Structure -->

    </div>
</div>


<script>

  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
  });

</script>

