<nav>
  <div class="nav-wrapper blue-grey darken-3 nav_links" >
      <div class="container">
        
        <a href="{{ url('/home') }}" class="brand-logo nav_links">Encerramento Contábil</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">

        @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle nav_links" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->nome }} <i class="fas fa-caret-down"></i>
                </a>

                
            </li>
        @endif
        


          <!--<li><a href="{{ route('comentario.index') }}" class="nav_links">Comentários</a></li>-->
          @can('admin')
          <li><a href="{{ route('admin.index') }}" class="nav_links">Admin</a></li>
          @endcan
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="{{ url('/home') }}" class="nav_links">Home</a></li>
          <li><a href="{{ route('tarefa.index') }}" class="nav_links">Minhas tarefas</a></li>
          <li><a href="{{ route('pendencia.index') }}" class="nav_links">Relatório</a></li>
          <!--<li><a href="{{ route('comentario.index') }}" class="nav_links">Comentários</a></li>-->
          <li><a href="#">Admin</a></li>
        </ul>
        </div>
  </div>
</nav>