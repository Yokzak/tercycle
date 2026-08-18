export default function transaksiFilter() {
    return {

        showFilter: false,

        openDetail: null,

        jenis: window.transaksiFilterData.jenis ?? [],

        statusPenukaran: window.transaksiFilterData.statusPenukaran ?? [],

        statusPenjualan: window.transaksiFilterData.statusPenjualan ?? [],

        statusPembelian: window.transaksiFilterData.statusPembelian ?? [],

        minPoin: Number(window.transaksiFilterData.minPoin ?? 0),

        maxPoin: Number(window.transaksiFilterData.maxPoin ?? 999999),


        get minPoinDisplay() {
            return this.formatPoin(this.minPoin);
        },


        get maxPoinDisplay() {
            return this.formatPoin(this.maxPoin);
        },


        formatPoin(value) {
            return Number(value || 0).toLocaleString('id-ID');
        },


        updateMinPoin() {

            if (this.minPoin > this.maxPoin) {
                this.maxPoin = this.minPoin;
            }

        },


        updateMaxPoin() {

            if (this.maxPoin < this.minPoin) {
                this.minPoin = this.maxPoin;
            }

        },


        updateMinPoinFromInput() {

            if (this.minPoin < 0) {
                this.minPoin = 0;
            }

            if (this.minPoin > 999999) {
                this.minPoin = 999999;
            }

            if (this.minPoin > this.maxPoin) {
                this.maxPoin = this.minPoin;
            }

        },


        updateMaxPoinFromInput() {

            if (this.maxPoin < 0) {
                this.maxPoin = 0;
            }

            if (this.maxPoin > 999999) {
                this.maxPoin = 999999;
            }

            if (this.maxPoin < this.minPoin) {
                this.minPoin = this.maxPoin;
            }

        },


        hasJenis(value) {
            return this.jenis.includes(value);
        },


        toggleDetail(id) {
            this.openDetail =
                this.openDetail === id
                    ? null
                    : id;
        },


        resetFilter() {

            this.minPoin = 0;

            this.maxPoin = 999999;

            this.jenis = [];

            this.statusPenukaran = [];

            this.statusPenjualan = [];

            this.statusPembelian = [];

        }

    };
}