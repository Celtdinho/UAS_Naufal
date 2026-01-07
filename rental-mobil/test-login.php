<?php
$conn = mysqli_connect(
  "sql306.epizy.com",
  "epiz_12345678",
  "PASSWORD_DB",
  "epiz_12345678_dbkursus"
);

if ($conn) {
  echo "KONEKSI DATABASE BERHASIL";
} else {
  echo "GAGAL: " . mysqli_connect_error();
}
