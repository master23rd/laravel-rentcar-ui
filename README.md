## About Laravel

Laravel Rental Car adalah aplikasi untuk pemesanan tiket mobil , dengan 2 aktor utama yakni administrator dan user. Berikut adalah fitur yang terdapat pada aplikasi:

- Sudah VITE sebagai development package.
- Menggunakan setingan Bootstrap sebagai frontend (laravel-ui)
- Admin CMS dilengkapi dengan datatable untuk pencarian.
- Aplikasi terbagi atas CMS dan Platform .
- Untuk keperluan testing disediakan migration dan seeder.
- Terdapat fitur manajemen Brand, Model dan Mobil
- Terdapat fitur manajemen Rental Admin (dapat mengupdate status peminjaman).
- Terdapat fitur standar Autentikasi Laravel dan Middleware Admin dan non admin.
- Terdapat fitur pencarian berdasrakan Model dan jumlah penumpang.
- Terdapat fitur pemesanan tiket/booked, pengelolaan daftar sewa dan pembayaran (hanya upload file - bisa tetap dihubungkan ke midtrans).
- terdapat fitur cancel dan softdelete.
- Database dirancang multi sewa many-to-many (namun untuk test hanya single data).
- Future Development : (Inertia.js, payment gateway, panel cms user, sewa multi mobil, pengecekan validasi lebih detail, pencarian non datatables.)

## Penggunaan aplikasi

- jalankan php artisan migrate
- jalankan php artisan db:seed --class=AdministratorSeeder (isi dummy admin)
- Login sebagai admin (password dan email bisa dicek di file AdministratorSeeder.php)
- isi brand, model , mobil lalu aktifkan status mobil
- buka platform untuk melihat hasil
- register sebagai user dan lakukan transkasi dengan mencari mobil
- lihat detail dan cek ketersedian (isi tanggal mulai dan akhir)
- lanjutkan dengan memesan mobil.
- submit dan kelola sewa mobil untuk merubah menjadi booked (buka /rents)
- lakukan pembayaran dengan upload bukti, maka status akan berubah menjadi paid.
- Admin dapat melakukan validasi, jika bukti sesuai maka status dapat diganti menjadi onduty.
- jika pengguna telah selesai maka admin dapat update status menjadi finish.
- user ataupun admin dapat melakukan cancel, jika status masih booked (khusus admin dapat merubah dalam kondisi apapun).
- cek data kendaraan di admin cms.
