<?php

namespace App\Models\Clinica;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClinicaModel extends Model {

	use HasFactory;

	protected $table    = 'tb_empresa';
	protected $fillable = ['titulo', 'nome_fantasia', 'razao_social', 'cnpj', 'inscricao_estadual', 'inscricao_municipal', 'cep', 'logradouro', 'numero', 'bairro', 'complemento', 'cidade', 'uf', 'pais', 'quem_somos', 'quem_somos_imagem', 'distribuidor_imagem', 'contato_imagem', 'telefone', 'celular', 'email', 'facebook', 'instagram', 'youtube', 'linkedin', 'github', 'gmaps', 'aliquota_imposto', 'tributacao', 'certificado', 'senha_certificado', 'ambiente', 'sequence_nfe', 'sequence_nfce', 'serie_nfe', 'serie_nfce', 'tokencsc', 'csc', 'matriz', 'status'];

}
