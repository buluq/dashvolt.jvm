# Standar Penulisan Kode

## Standar Penulisan Kode PHP

### Ringkasan

* Berkas PHP **hanya** menggunakan tanda `<?php`.
* Berkas PHP **hanya** menggunakan pengkodean UTF-8 tanda _byte order mark_ (BOM).
* Berkas PHP **harus** mendeklarasikan simbol (kelas, fungsi, konstanta, dan lain sebagainya)
  **atau** menghasilkan efek samping (menghasilkan keluaran, merubah berkas `.ini`, dan lain sebagainya)
  tetapi **jangan** melakukan keduanya (medeklarasikan simbol dan menghasilkan efek samping).
* Ruang nama (_namespace_) dan kelas **harus** mengikuti standar autoloading PSR-4.
* Nama kelas **hanya** dideklarasikan dalam bentuk `StudlyCaps`.
* konstanta kelas **hanya** dideklarasikan dengan huruf kapital semua
  dengan pemisah kata berupa tanda garis bawah.
* Nama metode **hanya** dideklarasikan dalam bentuk `camelCase`.
* Kode PHP **hanya** menggunakan 4 (empat) karakter spasi untuk indentasi, bukan karakter tab.
* Kode PHP **tidak boleh** memiliki batasan kaku dalam jumlah karakter dalam satu baris kode.
  Batasan lunak yang diperbolehkan **hanya** sebanyak 120 karakter. Panjang baris kode
  **sebaiknya** 80 karakter atau kurang.
* **Harus** ada 1 (satu) baris kosong tambahan setelah pendeklarasian ruang nama
  dan blok pendeklarasian `use`.
* Tanda kurung kurawal buka untuk kelas **harus** berada pada baris tersendiri
  yaitu baris selanjutnya. Tanda kurung kurawal tutup **harus** berada
  pada baris tersendiri yaitu baris selanjutnya.
* Tanda kurung kurawal buka untuk metode **harus** berada pada baris tersendiri
  yaitu baris selanjutnya. Tanda kurung kurawal tutup **harus** berada
  pada baris tersendiri yaitu baris selanjutnya.
* Visibilitas **harus** dideklarasikan pada semua properti dan metode.
  `abstract` dan `final` **harus** dideklarasikan sebelum visibilitas.
  `static` **harus** dideklarasikan setelah visibilitas.
* Kata kunci struktur pengendali **harus** memiliki 1 (satu) karakter spasi
  setelahnya sedangkan pemanggil metode dan fungsi **tidak boleh** terdapat
  karakter spasi setelahnya.
* Tanda kurung kurawal pembuka untuk struktur pengendali **harus** berada pada baris
  yang sama. Tanda kurung kurawal penutup struktur pengendali **harus** berada
  pada baris selanjutnya setelah isi.
* Tanda kurung pembuka untuk struktur pengendali **tidak boleh** diikuti
  karakter spasi setelahnya. Tanda kurung penutup struktur pengendali
  juga **tidak boleh** mengikuti karakter spasi sebelumnya.
