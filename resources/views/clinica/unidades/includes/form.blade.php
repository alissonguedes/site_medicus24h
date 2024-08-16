@if (request('id'))
@endif

<x-slot:forms>

	<x-form action="{{ route('clinica.unidades.post') }}" method="post" id="main-form" autocomplete="off">

		@csrf
		<input type="hidden" name="categoria" value="clinica">

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $row->id }}">
		@endif

		<x-slot:tabs>
			<ul class="tabs tabs-fixed-width">
				<li class="tab"><a href="#dados_fiscais">Dados Fiscais</a></li>
				{{-- <li class="tab"><a href="#departamentos">Departamentos</a></li> --}}
				<li class="tab"><a href="#informacoes_endereco">Endereço</a></li>
				<li class="tab"><a href="#informacoes_contato">Contato</a></li>
				<li class="tab"><a href="#outras_informacoes">Outros</a></li>
			</ul>
		</x-slot:tabs>

		<x-slot:content>

			<div class="row">

				<div class="col s12 m12 l12">

					<!-- BEGIN #dados_fiscais -->
					<div id="dados_fiscais">
						<div class="row">
							<div class="col s12 mt-3 mb-3">
								<h6>Dados Fiscais</h6>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m3 l2">
								<div class="profile flex flex-column flex-center">
									<div class="profile-image circle z-depth-2">
										<img src="{{ $imagem ?? asset('assets/img/logo/coracao-medicus.png') }}" style="@if (isset($img) && !getImg($img)) opacity: 0.45; filter: grayscale(1); @endif" alt="">
									</div>
									<div class="change-photo btn btn-floating z-depth-3 waves-effect blue lighten-1">
										<label for="imagem" class="material-symbols-outlined white-text cursor-pointer" style="line-height: inherit;">photo_camera</label>
										<input type="file" name="imagem" id="imagem" style="position: absolute; left: 0; top: 0; bottom: 0; opacity: 0; z-index: -1; cursor: pointer">
									</div>
								</div>
							</div>
							<div class="col s12 m10 l10">
								<div class="row">
									<div class="col s12 m6">
										<div class="input-field">
											<label for="razao_social">Razão Social</label>
											<input type="text" name="razao_social" id="razao_social" value="{{ old('razao_social') ?? ($row->razao_social ?? null) }}" autocapitalize="true">
										</div>
									</div>
									<div class="col s12 m6">
										<div class="input-field">
											{{-- <label for="nome_fantasia">Nome Fantasia</label>
												<input type="text" name="nome_fantasia" id="nome_fantasia" value="{{ $row->nome_fantasia ?? null }}" autocapitalize="true"> --}}
											<label for="titulo">Descrição</label>
											<input type="text" name="titulo" id="titulo" value="{{ old('titulo') ?? ($row->titulo ?? null) }}" autocapitalize="true">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col s12 m4">
										<div class="input-field">
											<label for="cnpj">CNPJ</label>
											<input type="tel" name="cnpj" id="cnpj" value="{{ old('cnpj') ?? ($row->cnpj ?? null) }}" data-mask="cnpj">
										</div>
									</div>
									<div class="col s12 m4">
										<div class="input-field">
											<label for="inscricao_estadual">Inscrição Estadual</label>
											<input type="tel" name="inscricao_estadual" id="inscricao_estadual" value="{{ old('inscricao_estadual') ?? ($row->inscricao_estadual ?? null) }}">
										</div>
									</div>
									<div class="col s12 m4">
										<div class="input-field">
											<label for="inscricao_municipal">Inscrição Municipal</label>
											<input type="tel" name="inscricao_municipal" id="inscricao_municipal" value="{{ old('inscricao_municipal') ?? ($row->inscricao_municipal ?? null) }}">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END #dados_fiscais -->

					{{-- <!-- BEGIN #departamentos -->
							<div id="departamentos">
								<div class="row">
									<div class="col s12 mt-3 mb-3">
										<h6>Atribuir Departamentos</h6>
									</div>
								</div>
								<div class="row">
									<div class="col s12 m12 l12">
										<div class="input-field">
											<table data-ajax="false">
												<thead>
													<tr>
														<th>
															<label>
																<input type="checkbox" name="check-all" id="check-all" class="filled-in">
																<span></span>
															</label>
														</th>
														<th>Departamento</th>
														<th>Descrição</th>
													</tr>
												</thead>
												<tbody>
													@if (isset($row))
													@php
														$departamento_model = new App\Models\Clinica\DepartamentoModel();
													@endphp
													@endif

													@foreach ($departamentos as $departamento)
														@if (isset($row))
														@php
															$depto = isset($row) ? $departamento_model->getDepartamentoEmpresa($row->id, $departamento->id) : null;
															$checked = isset($depto) && $departamento->id === $depto->id ? 'checked=checked' : null;
														@endphp
														<tr>
															<td>
																<label>
																	<input type="checkbox" name="departamento[]" class="filled-in" value="{{ $departamento->id }}" data-status="{{ $departamento->status }}" {{ $checked ?? null }}>
																	<span></span>
																</label>
															</td>
															<td>{{ $departamento->titulo }}</td>
															<td>{{ $departamento->descricao }}</td>
														</tr>
														@endif
													@endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!-- END #departamentos --> --}}

					<!-- BEGIN #informacoes_endereco -->
					<div id="informacoes_endereco">
						<div class="row">
							<div class="col s12 mt-3 mb-3">
								<h6>Endereço</h6>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m3 l3">
								<div class="input-field">
									<label for="cep">CEP</label>
									<input type="tel" name="cep" id="cep" value="{{ old('cep') ?? ($row->cep ?? null) }}" data-mask="cep">
								</div>
							</div>
							<div class="col s18 m6 l6">
								<div class="input-field">
									<label for="logradouro">Logradouro</label>
									<input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro') ?? ($row->logradouro ?? null) }}">
								</div>
							</div>
							<div class="col s4 m3 l3">
								<div class="input-field">
									<label for="numero">Número</label>
									<input type="tel" name="numero" id="numero" value="{{ old('numero') ?? ($row->numero ?? null) }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m6 l6">
								<div class="input-field">
									<label for="complemento">Complemento</label>
									<input type="text" name="complemento" id="complemento" value="{{ old('complemento') ?? ($row->complemento ?? null) }}">
								</div>
							</div>
							<div class="col s12 m6 l6">
								<div class="input-field">
									<label for="bairro">Bairro</label>
									<input type="text" name="bairro" id="bairro" value="{{ old('bairro') ?? ($row->bairro ?? null) }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m5 l5">
								<div class="input-field">
									<label for="cidade">Cidade</label>
									<input type="text" name="cidade" id="cidade" value="{{ old('cidade') ?? ($row->cidade ?? null) }}">
								</div>
							</div>
							<div class="col s12 m3 l3">
								<div class="input-field">
									<label for="uf">UF</label>
									<input type="text" name="uf" id="uf" value="{{ old('uf') ?? ($row->uf ?? null) }}">
								</div>
							</div>
							<div class="col s12 m4 l4">
								<div class="input-field">
									<label for="pais">País</label>
									<input type="text" name="pais" id="pais" value="{{ old('pais') ?? ($row->pais ?? null) }}">
								</div>
							</div>
						</div>
					</div>
					<!-- END #informacoes_endereco -->

					<!-- BEGIN #informacoes_contato -->
					<div id="informacoes_contato">
						<div class="row">
							<div class="col s12 mt-3 mb-3">
								<h6>Informações de contato</h6>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m6 l4">
								<div class="input-field">
									<label for="email">E-mail</label>
									<input type="email" name="email" id="email" value="{{ old('email') ?? ($row->email ?? null) }}">
								</div>
							</div>
							<div class="col s12 m3 l4">
								<div class="input-field">
									<label for="telefone">Telefone</label>
									<input type="tel" name="telefone" id="telefone" value="{{ old('telefone') ?? ($row->telefone ?? null) }}" data-mask="phone">
								</div>
							</div>
							<div class="col s12 m3 l4">
								<div class="input-field">
									<label for="celular">Celular</label>
									<input type="tel" name="celular" id="celular" value="{{ old('celular') ?? ($row->celular ?? null) }}" data-mask="celular">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col s12 mt-2 mb-3">
								<h6>Redes Sociais</h6>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m3 l4">
								<div class="input-field">
									<label for="instagram">Instagram</label>
									<input type="tel" name="instagram" id="instagram" value="{{ old('instagram') ?? ($row->instagram ?? null) }}">
								</div>
							</div>
							<div class="col s12 m3 l4">
								<div class="input-field">
									<label for="facebook">Facebook</label>
									<input type="tel" name="facebook" id="facebook" value="{{ old('facebook') ?? ($row->facebook ?? null) }}">
								</div>
							</div>
							<div class="col s12 m3 l4">
								<div class="input-field">
									<label for="youtube">YouTube</label>
									<input type="tel" name="youtube" id="youtube" value="{{ old('youtube') ?? ($row->youtube ?? null) }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col s12">
								<div class="input-field">
									<label for="gmaps">Mapa</label>
									<input type="tel" name="gmaps" id="gmaps" value="{{ old('gmaps') ?? ($row->gmaps ?? null) }}">
								</div>
							</div>
						</div>
					</div>
					<!-- END #informacoes_contato -->

					<!-- BEGIN #outras_informacoes -->
					<div id="outras_informacoes">
						<div class="row">
							<div class="col s12 mt-3 mb-3">
								<h6>Outras informações</h6>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m2 l12 mb-4">
								<div class="input-field">
									<label class="active">Imagem de apresentação</label>
								</div>
								<div class="foto capa flex flex-column flex-center mt-5">
									<div class="preview z-depth-4">
										<img src="{{ asset($row->quem_somos_imagem ?? 'assets/img/avatar/capa.jpg') }}" style="{{ isset($row) && empty($row->quem_somos_imagem) ? 'opacity: 0.1;filter: grayscale(1);' : null }}" alt="">
									</div>
									<div class="change-photo btn btn-large btn-floating z-depth-3 waves-effect blue lighten-1" data-tooltip="Alterar imagem">
										<label for="imagem" class="material-icons white-text cursor-pointer" style="line-height: inherit;">photo_camera</label>
										<input type="file" name="imagem" id="imagem" style="position: absolute; left: 0; top: 0; bottom: 0; opacity: 0; z-index: -1; cursor: pointer">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m4 l4">
								<label for="status" class="active blue-text text-accent-1">Clinica ativa</label>
								<div id="status" class="switch mt-3">
									<label>
										Off
										<input type="checkbox" name="status" id="status" value="1" @checked(!isset($row) || (isset($row) && ($row->status == '1' || $row->status == 'Ativo')))>
										<span class="lever"></span>
										On
									</label>
								</div>
							</div>
						</div>
						<!-- END #outras_informacoes -->
					</div>

				</div>

			</div>

		</x-slot:content>

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

		@include('clinica.unidades.includes.scripts')

	</x-form>

	<x-slot:form_delete action="{{ route('clinica.unidades.delete') }}">
		<p class="bold">Esta ação não poderá ser desfeita.</p>
		<br>
		<p>Tem certeza que deseja remover esta clínica?</p>
		<div id="item"></div>
	</x-slot:form_delete>

</x-slot:forms>
