<?php

namespace App\Models\Clinica {

	class ConvenioModel extends Model
	{

		// use HasApiTokens, HasFactory, Notifiable;

		protected $table = 'tb_convenio';

		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array<int, string>
		 */
		protected $fillable = [
			'name',
			'email',
			'password',
		];

		/**
		 * The attributes that should be hidden for serialization.
		 *
		 * @var array<int, string>
		 */
		protected $hidden = [
			'password',
			'remember_token',
		];

		/**
		 * The attributes that should be cast.
		 *
		 * @var array<string, string>
		 */
		protected $casts = [
			'email_verified_at' => 'datetime',
		];

		public $timestamps = false;

		public function getConvenio($id = null)
		{

			$get = $this->select('*');

			$get->where('status', '1');

			if (!is_array($id)) {
				if (!is_null($id)) {
					return $get->where('id', $id)
						->get()
						->first();
				}
			} else {

				foreach ($id as $ind => $val) {
					if (is_array($val)) {
						foreach ($val as $i => $v) {
							$get->where($ind, $i, $v);
						}
					}
				}

			}

			return $get->get();

		}

		public function getTipoConvenio($id = null, $id_convenio = null)
		{

			$get = $this->select('*');

			$get->from('tb_convenio_planos');

			$get->where('status', '1');

			if (!is_array($id)) {
				if (!is_null($id)) {
					return $get->where('id', $id)
						->get()
						->first();
				}
			} else {

				foreach ($id as $ind => $val) {
					if (is_array($val)) {
						foreach ($val as $i => $v) {
							$get->where($ind, $i, $v);
						}
					}
				}

			}

			return $get->get();

		}

		public function getAcomodacao($id = null)
		{

			$get = $this->select('*')
				->from('tb_acomodacao');

			$get->where('status', '1');

			if (!is_null($id)) {
				$get = $get->where('id', $id);
			}

			return $get->get();

		}

		public function addConvenioPaciente($dados = [])
		{

			$data = [
				'id_paciente'   => $dados['paciente'],
				'id_convenio'   => $dados['id_plano'],
				'id_tipo'       => $dados['id_tipo_plano'],
				'id_acomodacao' => $dados['id_acomodacao'],
				'matricula'     => $dados['matricula'],
				'validade_mes'  => $dados['validade_mes'],
				'validade_ano'  => $dados['validade_ano'],
			];

			return $this->from('tb_paciente_convenio')->updateOrInsert(['matricula' => $dados['matricula']], $data);

		}

	}

}
