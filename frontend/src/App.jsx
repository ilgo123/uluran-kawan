import React, { useEffect, useState } from 'react';
import Navbar from './components/layout/Navbar';
import Footer from './components/layout/Footer';
import CampaignCard from './components/ui/CampaignCard';

export default function App() {
  const [latestCampaigns, setLatestCampaigns] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchLatestCampaigns = async () => {
      setLoading(true);
      setError(null);
      try {
        const dummyData = [
          { id: 1, image_url: "/Konsep1.png", judul: "Bantuan Dana Skripsi Mahasiswa", nama_penggalang: "Ilham Prayogo Sampurno", donasi_terkumpul: 100000, target_donasi: 1000000, kategori: "Penelitian & Skripsi" },
          { id: 2, image_url: "/Konsep2.png", judul: "Beasiswa Pendidikan Anak Yatim", nama_penggalang: "Siti Mufathonah", donasi_terkumpul: 3046800, target_donasi: 5000000, kategori: "Biaya Pendidikan" },
          { id: 3, image_url: "/Konsep2.png", judul: "Donasi Buku Pelajaran untuk Panti", nama_penggalang: "Rafli Achmad Zulfikar", donasi_terkumpul: 4559999, target_donasi: 5000000, kategori: "Buku & Alat Belajar" },
          { id: 4, image_url: "/Konsep3.png", judul: "Bantuan Biaya Kost Mahasiswa Rantau", nama_penggalang: "Tia Ramadhani", donasi_terkumpul: 1066502, target_donasi: 5000000, kategori: "Biaya Kost & Hidup" },
          { id: 5, image_url: "/Konsep2.png", judul: "Pengobatan Pasien Kurang Mampu", nama_penggalang: "Muhamad Irfan Fadilah", donasi_terkumpul: 1865490, target_donasi: 5000000, kategori: "Kesehatan & Medis" },
          { id: 6, image_url: "/Konsep3.png", judul: "Pengadaan Laptop untuk Belajar Online", nama_penggalang: "Azril Ilham Pramudya", donasi_terkumpul: 8683840, target_donasi: 10000000, kategori: "Perangkat Belajar" },
          { id: 7, image_url: "/Konsep1.png", judul: "Bantuan Biaya Kuliah Semester Akhir", nama_penggalang: "Ilgo", donasi_terkumpul: 1132980, target_donasi: 5000000, kategori: "Biaya Pendidikan" },
          { id: 8, image_url: "/Konsep1.png", judul: "Membantu Penelitian Ilmiah Mahasiswa", nama_penggalang: "Siti", donasi_terkumpul: 3688180, target_donasi: 5000000, kategori: "Penelitian & Skripsi" },
          { id: 9, image_url: "/Konsep3.png", judul: "Dana Operasional Komunitas Belajar", nama_penggalang: "Tia", donasi_terkumpul: 1000000, target_donasi: 2000000, kategori: "Lain-lain" },
        ];

        setLatestCampaigns(dummyData.slice(0, 6));
      } catch (err) {
        console.error("Gagal fetch latest campaigns:", err);
        setError("Gagal memuat campaign terbaru. Coba lagi nanti.");
        setLatestCampaigns([]);
      } finally {
        setLoading(false);
      }
    };

    fetchLatestCampaigns();
  }, []);

  return (
    <>
      <Navbar />
      <div className="bg-white min-h-screen">
        {/* Hero Section */}
        <section className="bg-gray-100 py-16 md:py-20 px-4 md:px-8 lg:px-12 text-center">
          <h1 className="text-3xl md:text-4xl font-bold text-gray-800 mb-4 md:mb-6">
            Bantu Wujudkan Mimpi Mereka
          </h1>
          <p className="text-base md:text-lg text-gray-600 max-w-2xl mx-auto mb-6 md:mb-8">
            Satu uluran tangan Anda bisa menjadi awal dari sebuah perubahan besar bagi
            pendidikan dan kehidupan mahasiswa yang membutuhkan.
          </p>
          <a
            href="/explore"
            className="inline-block bg-green-600 text-white text-base font-semibold px-6 py-2.5 rounded-md hover:bg-green-700 transition-colors shadow-lg"
          >
            Jelajahi Campaign
          </a>
        </section>

        {/* Section Campaign Terbaru */}
        <section className="py-12 md:py-16 px-4 md:px-8 lg:px-12 max-w-screen-xl mx-auto">
          <h2 className="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-8 md:mb-10">
            Campaign Terbaru
          </h2>
          {loading ? (
            <p className="text-center text-gray-500 text-base md:text-lg">Memuat campaign terbaru...</p>
          ) : error ? (
            <p className="text-center text-red-500 text-base md:text-lg">{error}</p>
          ) : (
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
              {latestCampaigns.length > 0 ? (
                latestCampaigns.map((campaign) => (
                  <CampaignCard
                    key={campaign.id}
                    image={campaign.image_url}
                    title={campaign.judul}
                    author={campaign.nama_penggalang}
                    raised={campaign.donasi_terkumpul}
                    goal={campaign.target_donasi}
                  />
                ))
              ) : (
                <p className="text-center col-span-full text-gray-500 text-base md:text-lg">
                  Belum ada campaign terbaru.
                </p>
              )}
            </div>
          )}
        </section>
      </div>
      <Footer />
    </>
  );
}
