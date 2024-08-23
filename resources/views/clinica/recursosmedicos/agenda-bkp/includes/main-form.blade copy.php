@php
	$id = null;
@endphp

<x-form action="{{ route('clinica.recursosmedicos.agenda.index') }}">

	@csrf
	<input type="hidden" name="categoria" value="agenda">

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	{{-- <x-slot:tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#dados-pessoais" class="active">Dados Pessoais</a></li>
			<li class="tab"><a href="#contato">Contato</a></li>
			<li class="tab"><a href="#endereco">Endereço</a></li>
			<li class="tab"><a href="#convenio">Convênio</a></li>
			<li class="tab"><a href="#observacoes">Observações</a></li>
			<li class="tab"><a href="#outras_informacoes">Outras informações</a></li>
		</ul>
	</x-slot:tabs> --}}

	<div class="row">
		<div class="col s12">
			<p>Aqui, você pode informar os dias e horários que está disponível para atendimento na clínica.</p>
		</div>
	</div>

	<hr class="">

	<div class="row">
		<div class="col s12">
			<label for="titulo" class="active">Dias de disponibilidade:</label>
		</div>
	</div>

	<div class="row">
		<div class="col s12">
			<div class="mt-2">
				<label>
					<input type="checkbox" class="filled-in">
					<span> Domingo </span>
				</label>
			</div>
		</div>
		<div class="col s12">
			<div class="input-field">
				<label for="horario_domingo">Horários</label>
				<input type="text">
			</div>
			{{-- <label class="strong">01:00 - 02:00</label> --}}
		</div>
	</div>

	<div class="row">
		<div class="col s12">

			<div class="mt-2">
				{{-- <input type="text" name="titulo" id="titulo" value=""> --}}
				<label>
					<input type="checkbox" class="filled-in">
					<span> Segunda </span>
				</label>
			</div>

			<div class="mt-2">
				{{-- <input type="text" name="titulo" id="titulo" value=""> --}}
				<label>
					<input type="checkbox" class="filled-in">
					<span> Terça </span>
				</label>
			</div>

			<div class="mt-2">
				{{-- <input type="text" name="titulo" id="titulo" value=""> --}}
				<label>
					<input type="checkbox" class="filled-in">
					<span> Quarta </span>
				</label>
			</div>

			<div class="mt-2">
				{{-- <input type="text" name="titulo" id="titulo" value=""> --}}
				<label>
					<input type="checkbox" class="filled-in">
					<span> Quinta </span>
				</label>
			</div>

			<div class="mt-2">
				{{-- <input type="text" name="titulo" id="titulo" value=""> --}}
				<label>
					<input type="checkbox" class="filled-in">
					<span> Sexta </span>
				</label>
			</div>

			<div class="mt-2">
				{{-- <input type="text" name="titulo" id="titulo" value=""> --}}
				<label>
					<input type="checkbox" class="filled-in">
					<span> Sábado </span>
				</label>
			</div>

		</div>
	</div>

	<x-slot:footer>
		<div class="row">
			<div class="col s12 right-align">
				<button type="reset" class="btn btn-large waves-effect">
					<i class="material-symbols-outlined hide-on-small-only left">cancel</i>
					<span class="">Cancelar</span>
				</button>
				<button type="submit" class="btn btn-large waves-effect">
					<i class="material-symbols-outlined hide-on-small-only left">save</i>
					<span class="">Salvar</span>
				</button>
			</div>
		</div>
	</x-slot:footer>

</x-form>
