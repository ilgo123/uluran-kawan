import React, { useEffect, useState, useCallback } from "react";
import CampaignCard from "../components/ui/CampaignCard";
import Navbar from "../components/layout/Navbar";
import Footer from "../components/layout/Footer";

export default function ExploreCampaign() {
  const [campaigns, setCampaigns] = useState([]);
  const [search, setSearch] = useState("");
  const [category, setCategory] = useState("Semua");
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const categories = [
    "Semua",
    "Biaya Pendidikan",
    "Buku & Alat Belajar",
    "Penelitian & Skripsi",
    "Biaya Kost & Hidup",
    "Kesehatan & Medis",
    "Perangkat Belajar",
    "Lain-lain",
  ];

  const fetchCampaigns = useCallback(async () => {
    setLoading(true);
    setError(null);

    const queryParams = new URLSearchParams();
    if (search) queryParams.append("search", search);
    if (category && category !== "Semua") queryParams.append("kategori", category);

    try {
      // --- Data dummy untuk pengembangan tanpa backend aktif ---
      const allDummyData = [
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
      // --- Akhir Data Dummy ---

      // Jika backend sudah aktif, uncomment baris di bawah dan komentari dummyData
    //   const response = await fetch(`http://localhost:8000/api/campaigns?${queryParams.toString()}`);
    //   if (!response.ok) {
    //     throw new Error(`HTTP error! status: ${response.status}`);
    //   }
    //   const data = await response.json();
    //   setCampaigns(data.data || []);

      // Logika Filtering untuk Dummy Data
      let filteredData = allDummyData;

      if (search) {
        filteredData = filteredData.filter(campaign =>
          campaign.judul.toLowerCase().includes(search.toLowerCase())
        );
      }

      if (category && category !== "Semua") {
        filteredData = filteredData.filter(campaign =>
          campaign.kategori === category
        );
      }

      setCampaigns(filteredData); // Gunakan filteredData

    } catch (err) {
      console.error("Gagal fetch campaign:", err);
      setError("Gagal memuat campaign. Coba lagi nanti.");
      setCampaigns([]);
    } finally {
      setLoading(false);
    }
  }, [search, category]); // Tambahkan 'category' sebagai dependency useCallback

  useEffect(() => {
    fetchCampaigns();
  }, [fetchCampaigns]);

  return (
    <>
      <Navbar />
      <div className="min-h-screen bg-gray-50 text-gray-900 px-4 md:px-8 lg:px-12 py-8 md:py-10 max-w-screen-xl mx-auto">
        {/* Judul */}
        <h1 className="text-2xl md:text-3xl font-bold text-center mb-6 md:mb-8">Semua Campaign Aktif</h1>

        {/* Search bar */}
        <div className="flex justify-center mb-5 md:mb-6">
          <input
            type="text"
            placeholder="Cari judul campaign..."
            className="border border-gray-300 rounded-l-md px-3 py-1.5 md:px-4 md:py-2 w-full max-w-sm md:max-w-md focus:outline-none focus:ring-1 focus:ring-green-500 text-sm md:text-base"
            value={search}
            onChange={(e) => setSearch(e.target.value)}
            onKeyPress={(e) => {
              if (e.key === 'Enter') {
                fetchCampaigns(); // Trigger fetch saat Enter ditekan
              }
            }}
          />
          <button
            onClick={fetchCampaigns} // Trigger fetch saat tombol Cari diklik
            className="px-4 py-1.5 md:px-5 md:py-2 bg-green-600 text-white rounded-r-md hover:bg-green-700 transition-colors text-sm md:text-base"
          >
            Cari
          </button>
        </div>

        {/* Filter kategori */}
        <div className="flex flex-wrap justify-center gap-1.5 md:gap-2 mb-8 md:mb-10">
          {categories.map((cat) => (
            <button
              key={cat}
              onClick={() => setCategory(cat)} // Update state 'category' saat tombol diklik
              className={`
                px-3 py-1.5 rounded-full text-xs md:text-sm font-medium border
                ${category === cat
                  ? "bg-green-600 text-white shadow-sm"
                  : "bg-gray-100 text-gray-700 hover:bg-gray-200 border-gray-200"
                }
                transition-all duration-200 ease-in-out
              `}
            >
              {cat}
            </button>
          ))}
        </div>

        {/* Grid campaign */}
        {loading ? (
          <p className="text-center text-gray-500 text-base md:text-lg">Memuat data campaign...</p>
        ) : error ? (
          <p className="text-center text-red-500 text-base md:text-lg">{error}</p>
        ) : (
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
            {campaigns.length > 0 ? (
              campaigns.map((campaign) => (
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
                Tidak ada campaign ditemukan.
              </p>
            )}
          </div>
        )}
      </div>
      <Footer />
    </>
  );
}
