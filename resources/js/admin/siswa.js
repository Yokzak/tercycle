export default function adminSiswa() {
    return {
        siswas: [],
        search: '',
        currentPage: 1,
        perPage: 10,
        studentModal: false,

        student: {
            nama_lengkap: '',
            nis: '',
            no_telepon: '',
            kelas: '',
            jurusan_id: '',
        },

        detailModal: false,
        selectedSiswa: null,
        editModal: false,

        editSiswa: {
            id: null,
            nama_lengkap: '',
            nis: '',
            no_telepon: '',
            kelas: '',
            jurusan_id: '',
        },

        showJurusanOptions: false,
        showAddJurusanModal: false,
        showDeleteJurusanModal: false,

        selectedJurusan: [],

        newJurusan: {
            kode_jurusan: '',
            nama_jurusan: '',
        },

        init() {
            // Data siswa akan dimasukkan dari Blade
        },

        get filteredSiswas() {
            if (!this.search.trim()) {
                return this.siswas;
            }

            const keyword = this.search.toLowerCase();

            return this.siswas.filter(siswa => {
                return (
                    (siswa.nama_lengkap ?? '')
                        .toLowerCase()
                        .includes(keyword) ||

                    (siswa.nis ?? '')
                        .toLowerCase()
                        .includes(keyword) ||

                    (siswa.kode_siswa ?? '')
                        .toLowerCase()
                        .includes(keyword) ||

                    (siswa.kelas ?? '')
                        .toLowerCase()
                        .includes(keyword) ||

                    (siswa.jurusan?.kode_jurusan ?? '')
                        .toLowerCase()
                        .includes(keyword)
                );
            });
        },

        get totalPages() {
            return Math.ceil(
                this.filteredSiswas.length / this.perPage
            );
        },

        get paginatedSiswas() {
            const start =
                (this.currentPage - 1) * this.perPage;

            return this.filteredSiswas.slice(
                start,
                start + this.perPage
            );
        },

        get startItem() {
            if (this.filteredSiswas.length === 0) {
                return 0;
            }

            return (
                (this.currentPage - 1) *
                this.perPage
            ) + 1;
        },

        get endItem() {
            return Math.min(
                this.currentPage * this.perPage,
                this.filteredSiswas.length
            );
        },

        searchStudents() {
            this.currentPage = 1;
        },

        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },

        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },

        goToPage(page) {
            if (
                page >= 1 &&
                page <= this.totalPages
            ) {
                this.currentPage = page;
            }
        },

        openDetail(siswa) {
            this.selectedSiswa = siswa;
            this.detailModal = true;
        },

        closeDetail() {
            this.detailModal = false;
            this.selectedSiswa = null;
        },

        openEdit(siswa) {
            this.editSiswa = {
                id: siswa.id,
                nama_lengkap: siswa.nama_lengkap ?? '',
                nis: siswa.nis ?? '',
                no_telepon: siswa.no_telepon ?? '',
                kelas: siswa.kelas ?? '',
                jurusan_id: siswa.jurusan_id ?? '',
            };

            this.editModal = true;
        },

        closeEdit() {
            this.editModal = false;

            this.editSiswa = {
                id: null,
                nama_lengkap: '',
                nis: '',
                no_telepon: '',
                kelas: '',
                jurusan_id: '',
            };
        },

        resetStudent() {
            this.student = {
                nama_lengkap: '',
                nis: '',
                no_telepon: '',
                kelas: '',
                jurusan_id: '',
            };
        },

        resetJurusan() {
            this.newJurusan = {
                kode_jurusan: '',
                nama_jurusan: '',
            };

            this.selectedJurusan = [];
        },
    };
}