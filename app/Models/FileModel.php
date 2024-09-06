<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

define('CHUNK_SIZE', 128 * 500);

class FileModel extends Model
{

	use HasFactory;

	protected $table = 'tb_file';

	protected $fillable = [
		'id_object',
		'id_file',
		'id_chunk',
		'categoria',
		'filedata',
		'key',
		'signature',
		'imagem',
		'imgname',
		'imgtype',
		'imgsize',
		'autor',
		'ordem',
		'tags',
		'hits',
		'url',
		'publicar_ini',
		'publicar_fim',
		'created_at',
		'updated_at',
		'status',
	];

	public function showFile(int $file_id, string $categoria)
	{

		$filedata = false;

		$info = $this->getInfoFromFile($file_id, $categoria);

		if (isset($info)) {

			$chunks = $this->getFile($info->id);

			if ($chunks->count() > 0) {

				header('Content-type: ' . $info->imgtype);

				foreach ($chunks as $chunk) {
					$filedata .= $chunk->filedata;
				}

				if (request('action') && request('action') === 'download') {

					header('Content-Description: File Preview/Download');
					header('Content-Disposition: attachment; filename=' . $info->imgname);
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . $info->imgsize);

					return $filedata;

				} else {

					$type = explode('/', $info->imgtype)[0];

					if ($type === 'image') {

						return $filedata;

					} else {

						$filedata = response()->json([
							'data' => $filedata,
							'type' => $info->imgtype,
							'name' => $info->imgname,
							'size' => $info->imgsize,
						], 200);

					}

				}

			}

		}

		return empty($filedata) ? false : $filedata;

		return redirect(route('dashboard'))->with('file_not_exists', 'Não foi possível realizar download do arquivo. <small>404 - Arquivo não encontrado.</small>');

	}

	public function fileExists(int $id_file, string $categoria)
	{

		$issetFile = $this->getInfoFromFile($id_file, $categoria);

		return isset($issetFile);

	}

	public function getInfoFromFile(int $id_file, string $categoria)
	{

		return $this->select(
			'id',
			'imgname',
			'imgsize',
			'imgtype'
		)
			->from('tb_file')
			->where('categoria', $categoria)
			->where('id_object', $id_file)
			->get()
			->first();
	}

	public function getFile($id_file)
	{

		return $this->select('filedata')
			->from('tb_file_chunk')
			->where('id_file', $id_file)
			->orderBy('id_chunk', 'asc')
			->get();

	}

	public function getWhere($data = null, $where = null)
	{

		$where = is_array($data) ? $data : [$data => $where];

		return $this->getColumns()->where($where)->first();

	}

	private static function _getKeyAndHash($data = false, $file = false)
	{

		if ($file) {
			$sha1 = base64_encode(sha1_file($data, true));
			$md5  = base64_encode(md5_file($data, true));
		} else {
			$sha1 = base64_encode(sha1($data, true));
			$md5  = base64_encode(md5($data, true));
		}

		$prefix = base64_encode(sha1(microtime(), true));
		$key    = str_replace(
			array('=', '+', '/'),
			array('', '-', '_'),
			substr($prefix, 0, 5) . $sha1
		);

		$hash = str_replace(
			array('=', '+', '/'),
			array('', '-', ' '),
			substr($sha1, 0, 16) . substr($md5, 0, 16)
		);

		return array($key, $hash);

	}

	public static function addAttachments($files, $object_id, $inline = false, $lang = false)
	{

		if (empty($files)) {
			return false;
		}

		$file = [];

		if (!empty($files)) {

			$file['name'] = $files->getClientOriginalName();
			$file['type'] = $files->getClientMimeType();
			$file['ext']  = $files->getClientOriginalExtension();
			$file['size'] = $files->getSize();
			$file['tmp']  = $files->getPathName();

		}

		return self::insert_or_update($object_id, $file);

	}

	private static function insert_or_update($object_id, $file)
	{

		// self::where('id_object', $object_id)->delete();

		list($key, $sig) = self::_getKeyAndHash($file['tmp'], true);

		$columns['id_object'] = $object_id;
		$columns['key']       = $key;
		$columns['signature'] = $sig;
		$columns['imgname']   = $file['name'];
		$columns['imgtype']   = $file['type'];
		$columns['imgsize']   = $file['size'];

		$columns['status']    = '1';
		$columns['categoria'] = request('categoria') ?? 'P';
		$where                = ['categoria' => request('categoria'), 'id_object' => $object_id];

		$id_file = FileModel::updateOrCreate($where, $columns);

		if (!empty($file)) {
			return self::write_file_chunk($id_file->id, $file);
		}

	}

	private static function write_file_chunk($file_id, $file, $chunk = CHUNK_SIZE)
	{

		self::from('tb_file_chunk')->where('id_file', $file_id)->delete();

		$_chunk  = 0;
		$offset  = 0;
		$fp      = fopen($file['tmp'], 'rb');
		$content = fread($fp, $file['size']);

		fclose($fp);

		while ($block = substr($content, $offset, $chunk)) {

			$columns = [
				'id_file'  => $file_id,
				'id_chunk' => $_chunk++,
				'filedata' => $block,
			];

			self::from('tb_file_chunk')->insert($columns);

			$offset += strlen($block);

		}

		return $_chunk;

	}

	public static function remove($id_object, $categoria)
	{

		$where   = ['id_object' => $id_object, 'categoria' => $categoria];
		$id_file = self::select('id')->where($where)->first();

		if (isset($id_file)) {

			self::from('tb_file_chunk')->where('id_file', $id_file->id)->delete();
			self::from('tb_file')->where($where)->delete();

		}

		return true;

	}

}
