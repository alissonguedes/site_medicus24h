<header>

	<nav class="navbar-color navbar-fixed z-depth-0">
		<div class="nav-wrapper">
			<a href="#" class="brand-logo skew-after">
				@if (isset($header))
					{{ $header }}
				@else
					<img src="{{ asset('assets/img/logo/logo.png') }}" alt="">
				@endif
			</a>
			<ul id="menu-nav" class="navbar-main right letterspacing">
				<li><a href="#home" class="">Início</a></li>
				<li><a href="#about-us" class="">Sobre Nós</a></li>
				<li><a href="#outros-servicos" class="">Serviços</a></li>
				<li><a href="#clinicas-parceiras" class="">Parceiros</a></li>
				<li><a href="#" class="">Contato</a></li>
				<li><a href="https://www.clubmedicus24h.com.br/" class="" target="_blank">Club Médicus24h</a></li>
			</ul>
			<button id="btn-menu" class="btn btn-flat transparent btn-floating btn-menu-nav waves-effect">
				<i class="material-symbols-outlined">menu</i>
			</button>
		</div>
	</nav>

</header>
