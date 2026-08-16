import './bootstrap';
import './produk-approval';
import Alpine from 'alpinejs';
import adminSiswa from './admin/siswa';
import kategoriProduk from './kategori-produk';

window.adminSiswa = adminSiswa;
window.kategoriProduk = kategoriProduk;
window.Alpine = Alpine;

Alpine.start();