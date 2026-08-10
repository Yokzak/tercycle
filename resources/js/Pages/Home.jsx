export default function Home() {
    return (
        <div className="min-h-screen bg-gray-900 text-white">

            {/* Navbar */}
            <nav className="border-b border-white/10">
                <div className="mx-auto flex h-20 max-w-7xl items-center justify-between px-6">

                    <a href="/" className="flex items-center gap-3">
                        <div className="flex h-10 w-10 items-center justify-center rounded-xl bg-green-500 font-bold text-gray-950">
                            E
                        </div>

                        <span className="text-xl font-bold">
                            Eco<span className="text-green-400">Point</span>
                        </span>
                    </a>

                    <div className="hidden items-center gap-8 md:flex">
                        <a href="#tentang" className="text-gray-300 hover:text-green-400">
                            Tentang
                        </a>

                        <a href="#cara-kerja" className="text-gray-300 hover:text-green-400">
                            Cara Kerja
                        </a>

                        <a href="#produk" className="text-gray-300 hover:text-green-400">
                            Produk
                        </a>
                    </div>

                    <div className="flex items-center gap-3">
                        <a
                            href="/login"
                            className="rounded-xl px-4 py-2 text-sm font-semibold text-gray-300 hover:text-white"
                        >
                            Masuk
                        </a>

                        <a
                            href="/register"
                            className="rounded-xl bg-green-500 px-5 py-2.5 text-sm font-semibold text-gray-950 hover:bg-green-400"
                        >
                            Daftar
                        </a>
                    </div>

                </div>
            </nav>


            {/* Hero */}
            <section className="relative overflow-hidden">

                <div className="mx-auto max-w-7xl px-6 py-28">

                    <div className="mx-auto max-w-3xl text-center">

                        <div className="mb-6 inline-flex rounded-full border border-green-400/20 bg-green-400/10 px-4 py-2 text-sm text-green-300">
                            ♻️ Ubah Sampah Menjadi Nilai
                        </div>

                        <h1 className="text-5xl font-bold tracking-tight sm:text-6xl">
                            Sampahmu Bisa Jadi{" "}
                            <span className="text-green-400">
                                Poin Berharga
                            </span>
                        </h1>

                        <p className="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-400">
                            Kumpulkan botol bekas, tukarkan menjadi poin,
                            lalu gunakan poin tersebut untuk membeli produk
                            yang tersedia di EcoPoint.
                        </p>

                        <div className="mt-10 flex justify-center gap-4">

                            <a
                                href="/register"
                                className="rounded-xl bg-green-500 px-6 py-3.5 font-semibold text-gray-950 hover:bg-green-400"
                            >
                                Mulai Sekarang
                            </a>

                            <a
                                href="#cara-kerja"
                                className="rounded-xl border border-white/10 bg-white/5 px-6 py-3.5 font-semibold hover:bg-white/10"
                            >
                                Cara Kerja
                            </a>

                        </div>

                    </div>

                </div>

            </section>


            {/* Statistik */}
            <section className="border-y border-white/10 bg-gray-950">

                <div className="mx-auto grid max-w-7xl grid-cols-2 gap-4 px-6 py-16 md:grid-cols-4">

                    <Stat number="1K+" text="Siswa" />

                    <Stat number="10K+" text="Botol Terkumpul" />

                    <Stat number="50K+" text="Poin Beredar" />

                    <Stat number="100+" text="Produk" />

                </div>

            </section>


            {/* Tentang */}
            <section id="tentang">

                <div className="mx-auto max-w-7xl px-6 py-24">

                    <div className="max-w-2xl">

                        <p className="text-sm font-semibold uppercase tracking-widest text-green-400">
                            Tentang EcoPoint
                        </p>

                        <h2 className="mt-4 text-4xl font-bold">
                            Satu sistem untuk mengelola sampah dan poin.
                        </h2>

                        <p className="mt-6 leading-7 text-gray-400">
                            EcoPoint membantu sekolah mengelola program
                            pengumpulan botol dengan sistem poin.
                            Siswa dapat mengumpulkan botol, mendapatkan poin,
                            dan menggunakan poin tersebut untuk membeli produk.
                        </p>

                    </div>

                </div>

            </section>


            {/* Cara Kerja */}
            <section
                id="cara-kerja"
                className="border-y border-white/10 bg-gray-950"
            >

                <div className="mx-auto max-w-7xl px-6 py-24">

                    <div className="text-center">

                        <p className="text-sm font-semibold uppercase tracking-widest text-green-400">
                            Cara Kerja
                        </p>

                        <h2 className="mt-4 text-4xl font-bold">
                            Mulai dari botol, berakhir jadi poin
                        </h2>

                    </div>


                    <div className="mt-16 grid gap-6 md:grid-cols-3">

                        <Step
                            number="01"
                            title="Kumpulkan Botol"
                            description="Kumpulkan botol bekas yang diterima oleh sekolah."
                        />

                        <Step
                            number="02"
                            title="Tukarkan"
                            description="Tunjukkan QR atau kode unik kepada admin."
                        />

                        <Step
                            number="03"
                            title="Dapatkan Poin"
                            description="Setelah dikonfirmasi, poin masuk ke saldo akun."
                        />

                    </div>

                </div>

            </section>


            {/* CTA */}
            <section className="bg-gray-950">

                <div className="mx-auto max-w-4xl px-6 py-24 text-center">

                    <h2 className="text-4xl font-bold">
                        Siap mulai mengumpulkan poin?
                    </h2>

                    <p className="mt-5 text-gray-400">
                        Daftar sekarang dan mulai tukarkan botolmu.
                    </p>

                    <a
                        href="/register"
                        className="mt-8 inline-block rounded-xl bg-green-500 px-7 py-3.5 font-semibold text-gray-950 hover:bg-green-400"
                    >
                        Buat Akun
                    </a>

                </div>

            </section>


            {/* Footer */}
            <footer className="border-t border-white/10">

                <div className="mx-auto max-w-7xl px-6 py-8 text-center text-sm text-gray-500">
                    © 2026 EcoPoint
                </div>

            </footer>

        </div>
    );
}


/*
|--------------------------------------------------------------------------
| Components kecil
|--------------------------------------------------------------------------
*/

function Stat({ number, text }) {
    return (
        <div className="rounded-2xl border border-white/10 bg-white/[0.03] p-6 text-center">
            <p className="text-3xl font-bold">{number}</p>
            <p className="mt-1 text-sm text-gray-500">{text}</p>
        </div>
    );
}


function Step({ number, title, description }) {
    return (
        <div className="rounded-2xl border border-white/10 bg-white/[0.03] p-8">

            <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-green-500 font-bold text-gray-950">
                {number}
            </div>

            <h3 className="mt-6 text-lg font-bold">
                {title}
            </h3>

            <p className="mt-3 text-sm leading-6 text-gray-500">
                {description}
            </p>

        </div>
    );
}