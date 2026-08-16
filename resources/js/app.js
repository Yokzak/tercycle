import './bootstrap';
import './produk-approval';
import Alpine from 'alpinejs';
import adminSiswa from './admin/siswa';
import transaksi from './transaksi';
import kategoriProduk from './kategori-produk';

window.adminSiswa = adminSiswa;
window.transaksi = transaksi;
window.kategoriProduk = kategoriProduk;
Alpine.data('transaksiFilter', transaksi);
window.Alpine = Alpine;

Alpine.start();