import React from 'react';

export default function Navbar() {
  return (
    <nav className="bg-white shadow-sm py-4 px-4 md:px-12 lg:px-20 flex justify-between items-center sticky top-0 z-50">
      {/* Logo */}
      <div className="text-xl md:text-2xl font-bold text-green-800">
        Uluran Kawan
      </div>

      {/* Navigasi Tengah */}
      {/* Sesuaikan ukuran font navigasi */}
      <div className="hidden md:flex space-x-6 lg:space-x-8 text-gray-700 text-sm md:text-base font-medium">
        <a href="/" className="hover:text-green-600 transition-colors">Beranda</a>
        <a href="/explore" className="hover:text-green-700 transition-colors">Campaigns</a>
      </div>

      {/* Tombol Kanan */}
      <div className="space-x-3 md:space-x-4">
        <button className="text-gray-700 text-sm md:text-base font-medium hover:text-green-700 transition-colors">
          Masuk
        </button>
        <button className="bg-green-800 text-white text-sm md:text-base px-4 py-1.5 md:px-5 md:py-2 rounded-md hover:bg-green-700 transition-colors">
          Daftar
        </button>
      </div>
    </nav>
  );
}
