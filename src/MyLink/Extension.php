<?php

namespace MyLink;

use \LogicException;

class Extension
{
	private $from,
		$to;

	public function __construct($from, $to)
	{
		if( !is_dir($to) )
		{
			throw new LogicException('To dir does not exists');
		}
		
		if( !is_dir($from) )
		{
			throw new LogicException('From dir does not exists');
		}
		
		$this->to = $to;
		$this->from = $from;

	}
	
	public function export()
	{
		$toCopy = array(
			'128.png',
			'manifest.json'
		);
		
		$manifest = new Manifest($this->from . DIRECTORY_SEPARATOR . 'manifest.json');
		
		$extension = $this->to . DIRECTORY_SEPARATOR . str_replace(' ', '', ucwords($manifest->getName()));

		if( !is_dir($extension) )
		{
			if( !is_writable($this->to) )
			{
				throw new LogicException('To dir is not writable');
			}

			mkdir($extension);
		}

		foreach( $toCopy as $val )
		{
			copy($this->from . DIRECTORY_SEPARATOR . $val,
				$extension . DIRECTORY_SEPARATOR . $val);
		}
	}
}
