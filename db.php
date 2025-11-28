<?php

$koneksi = mysqli_connect("localhost", "root", "", "ukk");

if(!$koneksi){
    die ("database connection error:". mysqli_connect_error);
}