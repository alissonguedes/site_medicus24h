<?php

namespace App\Models\Clinica;

use App\Http\Requests\Clinica\PacienteRequest;
use App\Models\Clinica\Model;
use App\Models\FileModel;
use Illuminate\Support\Facades\DB;

class PacienteModel extends Model {

	protected $table    = 'tb_paciente';
	protected $fillable = ['id', 'nome', 'codigo', 'imagem', 'associado', 'id_estado_civil', 'id_etnia',
		'sexo', 'data_nascimento', 'cpf', 'rg', 'cns', 'mae', 'pai', 'notas_gerais',
		'notas_alergias', 'notas_clinicas', 'logradouro', 'numero', 'complemento', 'cidade',
		'bairro', 'cep', 'uf', 'pais', 'email', 'telefone', 'celular', 'receber_notificacoes',
		'receber_email', 'receber_sms', 'obito', 'status',
		'matricula', 'id_tipo_convenio', 'id_acomodacao', 'validade'];

	public function getColumns() {

		return $this->select(
			'id', 'nome', 'codigo', 'imagem', 'associado', 'id_estado_civil', 'id_etnia',
			'sexo', 'data_nascimento', 'cpf', 'rg', 'cns', 'mae', 'pai', 'notas_gerais',
			'notas_alergias', 'notas_clinicas', 'logradouro', 'numero', 'complemento', 'cidade',
			'bairro', 'cep', 'uf', 'pais', 'email', 'telefone', 'celular', 'receber_notificacoes',
			'receber_email', 'receber_sms', 'obito', DB::raw('IF(status = "1", "Ativo", "Inativo") AS status'),
			'matricula', 'id_tipo_convenio', 'id_acomodacao', 'validade',
			DB::raw('(SELECT descricao FROM tb_convenio WHERE id = id_convenio) AS convenio'),
			DB::raw('(SELECT descricao FROM tb_convenio_planos WHERE id = id_tipo_convenio) AS tipo_plano'),
			DB::raw('(SELECT descricao FROM tb_acomodacao WHERE id = id_acomodacao) AS acomodacao'),
			DB::raw('DATE_FORMAT(datahora_obito, "%d/%m/%Y") AS data_obito'),
			DB::raw('DATE_FORMAT(datahora_obito, "%H:%i") AS hora_obito'),
			DB::raw('(SELECT descricao FROM tb_etnia WHERE id = id_etnia) AS etnia'),
			DB::raw('DATE_FORMAT(data_nascimento, "%d/%m/%Y") AS data_nascimento')
		);

	}

	public function get($data = null) {

		$get = $this->getColumns();

		if (isset($data) && $search = $data['query']) {
			$get->where(function ($query) use ($search) {
				$query
					->orWhere(DB::raw('REGEXP_REPLACE(codigo, "[^\\x20-\\x7E]", "")'), 'like', limpa_string($search, '') . '%')
					->orWhere('nome', 'like', $search . '%')
					->orWhere(DB::raw('REGEXP_REPLACE(matricula, "[^\\x20-\\x7E]", "")'), 'like', limpa_string($search, '') . '%')
					->orWhere(DB::raw('REGEXP_REPLACE(rg, "[^\\x20-\\x7E]", "")'), 'like', limpa_string($search, '') . '%')
					->orWhere('email', 'like', $search . '%')
					->orWhere(DB::raw('REGEXP_REPLACE(cpf, "[^\\x20-\\x7E]", "")'), 'like', limpa_string($search, '') . '%')
					->orWhere(DB::raw('REGEXP_REPLACE(cns, "[^\\x20-\\x7E]", "")'), 'like', limpa_string($search, '') . '%')
					->orWhere(DB::raw('REGEXP_REPLACE(telefone, "[^\\x20-\\x7E]", "")'), 'like', limpa_string($search, '') . '%')
					->orWhere(DB::raw('REGEXP_REPLACE(celular, "[^\\x20-\\x7E]", "")'), 'like', limpa_string($search, '') . '%');
			});
		}

		if (isset($data['status'])) {
			$get->where('status', $data['status']);
		}

		if (isset($data['obito'])) {
			$get->where('obito', $data['obito']);
		}

		$get->where('is_deleted', false);

		$this->order = [
			null,
			'nome',
			'telefone',
			'codigo',
			'data_nascimento',
			'convenio',
			DB::raw('IF(status = "1", "Ativo", "Inativo") AS status'),
			null,
		];

		// Order By
		if (isset($_GET['order']) && $_GET['order'][0]['column'] != 0) {
			$get->orderBy($this->order[$_GET['order'][0]['column']], $_GET['order'][0]['dir']);
		} else {
			$get->orderBy($this->order[1], 'asc');
		}

		return $get->paginate(isset($_GET['length']) ? $_GET['length'] : 50);

	}

	public function getWhere($data = null, $where = null) {

		$where = is_array($data) ? $data : [$data => $where];

		return $this->getColumns()->where('is_deleted', false)->where($where)->first();

	}

	public function search($search, $both = true) {

		return $this->getColumns()
			->whereAny([
				'nome',
				'email',
				DB::raw('REGEXP_REPLACE(codigo, "[^\\x20-\\x7E]", "")'),
				DB::raw('REGEXP_REPLACE(matricula, "[^\\x20-\\x7E]", "")'),
				DB::raw('REGEXP_REPLACE(rg, "[^\\x20-\\x7E]", "")'),
				DB::raw('REGEXP_REPLACE(cpf, "[^\\x20-\\x7E]", "")'),
				DB::raw('REGEXP_REPLACE(cns, "[^\\x20-\\x7E]", "")'),
				DB::raw('REGEXP_REPLACE(telefone, "[^\\x20-\\x7E]", "")'),
				DB::raw('REGEXP_REPLACE(celular, "[^\\x20-\\x7E]", "")'),
			], 'like', ($both ? '%' : null) . $search . '%')
			->where('is_deleted', false)
			->get();

	}

	public function cadastra(PacienteRequest $request) {

		$data = $request->all();
		unset($data['id'], $data['_method'], $data['_token'], $data['categoria']);

		$data['id_estado_civil'] = $data['estado_civil'] ?? 1;
		$data['id_etnia']        = $data['etnia'] ?? 1;
		$data['id_convenio']     = $data['convenio'] ?? 1;
		$data['observacoes']     = $data['notas'];
		$data['data_nascimento'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['data_nascimento'])));
		$imagem                  = $request->file('imagem');
		$matricula               = $data['matricula'] ?? gera_cartao(null, true);
		$data['matricula']       = $matricula;

		if (request()->method() == 'PUT') {

			// if (!empty($data['matricula'])) {
			// 	unset($data['matricula']);
			// }

			unset($data['codigo']);
		}

		if (empty($data['imagem'])) {
			unset($data['imagem']);
		}

		if (empty($data['status'])) {
			$data['status'] = '0';
		}

		unset($data['estado_civil'], $data['etnia'], $data['notas'], $data['convenio']);

		$id_paciente = $this->updateOrCreate(['cpf' => $data['cpf']], $data);

		FileModel::addAttachments($imagem, $id_paciente->id);

	}

	public function removePaciente($id) {

		$id = [$id];

		return $this->whereIn('id', $id)
			->update([
				'is_deleted' => '1',
				'deleted_at' => DB::raw('NOW()'),
			]);

		return true;

	}

}
