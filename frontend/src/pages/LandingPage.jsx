// import React, { useEffect, useState } from 'react';
// import Navbar from '../components/layout/Navbar';
// import Footer from '../components/layout/Footer';
// import CampaignCard from '../components/ui/CampaignCard';

// export default function LandingPage() {
//   const [latestCampaigns, setLatestCampaigns] = useState([]);
//   const [loading, setLoading] = useState(true);
//   const [error, setError] = useState(null);

//   useEffect(() => {
//     const fetchLatestCampaigns = async () => {
//       setLoading(true);
//       setError(null);
//       try {
//         // Data dummy untuk pengembangan tanpa backend aktif
//         // const dummyData = [
//         //   { id: 1, image_url: "https://via.placeholder.com/400x250?text=Campaign+1", judul: "Test update", nama_penggalang: "User Test upd", donasi_terkumpul: 0, target_donasi: 10000 },
//         //   { id: 2, image_url: "https://via.placeholder.com/400x250?text=Campaign+2", judul: "Fuga recusandae omnis quam perspiciatis eaque in", nama_penggalang: "Dr. Melie Effertz V", donasi_terkumpul: 304680, target_donasi: 500000 },
//         //   { id: 3, image_url: "https://via.placeholder.com/400x250?text=Campaign+3", judul: "Esse sunt facere ducimus et sed et.", nama_penggalang: "Duncan Block", donasi_terkumpul: 455999, target_donasi: 500000 },
//         //   { id: 4, image_url: "https://via.placeholder.com/400x250?text=Campaign+4", judul: "Ut dolore minima molestiae voluptatum.", nama_penggalang: "Paxton Roob", donasi_terkumpul: 1066502, target_donasi: 5000000 },
//         //   { id: 5, image_url: "https://via.placeholder.com/400x250?text=Campaign+5", judul: "Quae quo qui animi quo.", nama_penggalang: "Arturo Rosenbaum", donasi_terkumpul: 186549, target_donasi: 500000 },
//         //   { id: 6, image_url: "https://via.placeholder.com/400x250?text=Campaign+6", judul: "Consectetur enim est sequi.", nama_penggalang: "Judy Hamill PhD", donasi_terkumpul: 868384, target_donasi: 1000000 },
//         // ];

//         const response = await fetch(`http://localhost:8000/api/campaigns`); // Atau '/api/latest-campaigns' jika ada endpoint khusus
//         if (!response.ok) {
//           throw new Error(`HTTP error! status: ${response.status}`);
//         }
//         const data = await response.json();
//         // Asumsi data.data adalah array campaigns, dan kita hanya ingin beberapa (misal 6)
//         setLatestCampaigns(data.data.slice(0, 6) || []); // Ambil 6 dari dummy data
//         // setLatestCampaigns(dummyData.slice(0, 6));
//       } catch (err) {
//         console.error("Gagal fetch latest campaigns:", err);
//         setError("Gagal memuat campaign terbaru. Coba lagi nanti.");
//         setLatestCampaigns([]);
//       } finally {
//         setLoading(false);
//       }
//     };

//     fetchLatestCampaigns();
//   }, []);

//   return (
//     <>
//       <Navbar />
//       <div className="bg-white min-h-screen">
//         {/* Hero Section */}
//         <section className="bg-gray-100 py-16 md:py-20 px-4 md:px-8 lg:px-12 text-center">
//           <h1 className="text-3xl md:text-4xl font-bold text-gray-800 mb-4 md:mb-6">
//             Bantu Wujudkan Mimpi Mereka
//           </h1>
//           <p className="text-base md:text-lg text-gray-600 max-w-2xl mx-auto mb-6 md:mb-8">
//             Satu uluran tangan Anda bisa menjadi awal dari sebuah perubahan besar bagi
//             pendidikan dan kehidupan mahasiswa yang membutuhkan.
//           </p>
//           <a
//             href="/explore"
//             className="inline-block bg-green-600 text-white text-base font-semibold px-6 py-2.5 rounded-md hover:bg-green-700 transition-colors shadow-lg"
//           >
//             Jelajahi Campaign
//           </a>
//         </section>

//         {/* Section Campaign Terbaru */}
//         {/* Tambahkan max-w-screen-xl mx-auto untuk membatasi lebar konten */}
//         <section className="py-12 md:py-16 px-4 md:px-8 lg:px-12 max-w-screen-xl mx-auto">
//           <h2 className="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-8 md:mb-10">
//             Campaign Terbaru
//           </h2>
//           {loading ? (
//             <p className="text-center text-gray-500 text-base md:text-lg">Memuat campaign terbaru...</p>
//           ) : error ? (
//             <p className="text-center text-red-500 text-base md:text-lg">{error}</p>
//           ) : (
//             <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5"> {/* Kurangi gap */}
//               {latestCampaigns.length > 0 ? (
//                 latestCampaigns.map((campaign) => (
//                   <CampaignCard
//                     key={campaign.id}
//                     image={campaign.image_url}
//                     title={campaign.judul}
//                     author={campaign.nama_penggalang}
//                     raised={campaign.donasi_terkumpul}
//                     goal={campaign.target_donasi}
//                   />
//                 ))
//               ) : (
//                 <p className="text-center col-span-full text-gray-500 text-base md:text-lg">
//                   Belum ada campaign terbaru.
//                 </p>
//               )}
//             </div>
//           )}
//         </section>
//       </div>
//       <Footer />
//     </>
//   );
// }
