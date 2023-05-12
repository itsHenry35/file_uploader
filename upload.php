<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$uploadDirectory = 'd:/uloaded/';

	$errors = [];
	$uploadedFiles = [];

	if (!empty($_FILES['files'])) {
		foreach ($_FILES['files']['name'] as $key => $name) {
			$tempName = $_FILES['files']['tmp_name'][$key];
			$destination = $uploadDirectory . $name;

			if (move_uploaded_file($tempName, $destination)) {
				$uploadedFiles[] = $name;
			} else {
				$errors[] = 'Error uploading file: ' . $name;
			}
		}
	}

	$response = ['uploadedFiles' => $uploadedFiles, 'errors' => $errors];

	$text = '';
	foreach ($uploadedFiles as $file) {
		$text .= $file . "\n";
	}
	foreach ($errors as $error) {
		$text .= $error . "\n";
	}

	echo $text;
	exit;
}
