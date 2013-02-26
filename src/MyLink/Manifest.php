<?php

namespace MyLink;

use \LogicException;

class Manifest
{
	private $filename,
			$json;
	
	public function __construct($filename)
	{
		if( !is_file($filename) )
		{
			throw new LogicException('File name does not exist.'); 
		}
		
		$this->filename = $filename;
		
		$this->json = json_decode(file_get_contents($this->filename));
		
		if( is_null($this->json) )
		{
			throw new LogicException('Manifest is not well formated.');
		}
	}
	
	public function config(array $config)
	{
		foreach( $config as $key => $value )
		{
			$methodName = 'set' . ucfirst(strtolower($key));
			
			if( !method_exists($this, $methodName))
			{
				throw new LogicException(
					sprintf(
						'Config %s is not implemented',
						$key
					)
				);
			}
			
			$this->$methodName($value);
		}
		
		$this->save();
		
		return $this;
	}
	
	public function save()
	{
		if( is_null($this->filename)
			&& is_null($this->json) )
		{
			return $this;
		}
		
		file_put_contents($this->filename, json_encode($this->json, JSON_PRETTY_PRINT));
		
		return $this;
	}
	
	protected function setName($name)
	{
		$this->json->name = (string) $name;
	}
	
	public function getName()
	{
		return $this->json->name;
	}

	protected function setDescription($description)
	{
		$this->json->description = (string) $description;
	}

	protected function setUrl($url)
	{
		$this->json->app->launch->web_url = (string) $url;
		$this->json->app->web_content->origin = (string) $url;
	}
}
