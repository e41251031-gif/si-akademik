<?php

require_once "../app/Models/Mahasiswa.php";

$mahasiswa = [
    new Mahasiswa("E41251031", "Siti Maisyaroh", "Teknik Informatika"),
    new Mahasiswa("E41251032", "Mahasiswa Contoh", "Teknik Informatika")
];

include "../app/Views/mahasiswa/index.php";