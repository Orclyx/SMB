<?php

namespace Icewind\SMB;

abstract class AbstractAuth implements IAuth {
	/** @var resource */
	protected $file;

	public function __construct() {
		$file = tmpfile();
		if ($file === false) {
			throw new \RuntimeException('Unable to create temporary file.');
		}
		$this->file = $file;
	}

	public function __destruct()
	{
		unlink(stream_get_meta_data($this->file)['uri']);
	}

	public function getFile()
	{
		return $this->file;
	}
}