<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use MyLink\Manifest;
use MyLink\Extension;

$console = new Application();

$console
	->register('name')
	->setDefinition(array(
			new InputArgument('name', InputArgument::REQUIRED, 'Name'),
	))
	->setDescription('Change name of the extension')
	->setCode(function (InputInterface $input, OutputInterface $output) {
		$manifest = new Manifest(__DIR__ . '/../manifest.json');
		$manifest->config(array(
			'name' => $input->getArgument('name')
		));
		$output->writeln('Done');
	})
	;
	
$console
	->register('description')
	->setDefinition(array(
			new InputArgument('description', InputArgument::REQUIRED, 'Description'),
	))
	->setDescription('Change description of the extension')
	->setCode(function (InputInterface $input, OutputInterface $output) {
		$manifest = new Manifest(__DIR__ . '/../manifest.json');
		$manifest->config(array(
			'description' => $input->getArgument('description')
		));
		$output->writeln('Done');
	})
	;
	
$console
	->register('url')
	->setDefinition(array(
			new InputArgument('url', InputArgument::REQUIRED, 'Url'),
	))
	->setDescription('Change url')
	->setCode(function (InputInterface $input, OutputInterface $output) {
		$manifest = new Manifest(__DIR__ . '/../manifest.json');
		$manifest->config(array(
			'url' => $input->getArgument('url')
		));
		$output->writeln('Done');
	})
	;
	
$console
	->register('config')
	->setDefinition(array(
			new InputArgument('name', InputArgument::OPTIONAL, 'Name'),
			new InputArgument('description', InputArgument::OPTIONAL, 'Description'),
			new InputArgument('url', InputArgument::OPTIONAL, 'Url'),
	))
	->setDescription('Change name of the extension')
	->setCode(function (InputInterface $input, OutputInterface $output) {
		$manifest = new Manifest(__DIR__ . '/../manifest.json');
		$manifest->config(array(
			'name' => $input->getArgument('name'),
			'description' => $input->getArgument('description'),
			'url' => $input->getArgument('url')
		));
		$output->writeln('Done');
	})
	;

$console
	->register('export')
	->setDefinition(array(
			new InputArgument('path', InputArgument::REQUIRED, 'Path'),
	))
	->setDescription('Change name of the extension')
	->setCode(function (InputInterface $input, OutputInterface $output) {
		$extension = new Extension(__DIR__ . DIRECTORY_SEPARATOR . '..', $input->getArgument('path'));
		$extension->export();
		$output->writeln('Done');
	})
	;

$console->run();
