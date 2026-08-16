export default function transaksiFilter() {
    return {
        // =========================================================
        // FILTER PANEL
        // =========================================================

        showFilter: false,

        // =========================================================
        // DETAIL TRANSAKSI
        // =========================================================

        openDetail: null,

        toggleDetail(id) {
            if (this.openDetail === id) {
                this.openDetail = null;
            } else {
                this.openDetail = id;
            }
        },

        // =========================================================
        // FILTER JENIS
        // =========================================================

        jenis: [],

        // =========================================================
        // FILTER POIN
        // =========================================================

        minPoin: 0,
        maxPoin: 9999999,

        minPoinDisplay: '0',
        maxPoinDisplay: '9.999.999',

        // =========================================================
        // FILTER STATUS
        // =========================================================

        statusPenukaran: [],
        statusPenjualan: [],
        statusPembelian: [],

        // =========================================================
        // INIT
        // =========================================================

        init() {
            const data = window.transaksiFilterData ?? {};

            this.jenis = Array.isArray(data.jenis)
                ? data.jenis
                : [];

            this.statusPenukaran = Array.isArray(data.statusPenukaran)
                ? data.statusPenukaran
                : [];

            this.statusPenjualan = Array.isArray(data.statusPenjualan)
                ? data.statusPenjualan
                : [];

            this.statusPembelian = Array.isArray(data.statusPembelian)
                ? data.statusPembelian
                : [];

            this.minPoin = Number(
                data.minPoin ?? 0
            );

            this.maxPoin = Number(
                data.maxPoin ?? 999999999
            );

            this.updatePoinDisplay();
        },

        // =========================================================
        // FORMAT POIN
        // =========================================================

        formatPoin(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        },

        updatePoinDisplay() {
            this.minPoinDisplay =
                this.formatPoin(this.minPoin);

            this.maxPoinDisplay =
                this.formatPoin(this.maxPoin);
        },

        // =========================================================
        // SLIDER MINIMUM
        // =========================================================

        updateMinPoin(event) {
            const value = Number(event.target.value);

            if (value > this.maxPoin) {
                this.minPoin = this.maxPoin;
            } else {
                this.minPoin = value;
            }

            this.updatePoinDisplay();
        },

        // =========================================================
        // SLIDER MAXIMUM
        // =========================================================

        updateMaxPoin(event) {
            const value = Number(event.target.value);

            if (value < this.minPoin) {
                this.maxPoin = this.minPoin;
            } else {
                this.maxPoin = value;
            }

            this.updatePoinDisplay();
        },

        // =========================================================
        // RESET FILTER
        // =========================================================

        resetFilter() {
            this.jenis = [];

            this.statusPenukaran = [];
            this.statusPenjualan = [];
            this.statusPembelian = [];

            this.minPoin = 0;
            this.maxPoin = 999999999;

            this.updatePoinDisplay();
        },

        // =========================================================
        // CEK JENIS
        // =========================================================

        hasJenis(jenis) {
            return this.jenis.includes(jenis);
        }
    };
}