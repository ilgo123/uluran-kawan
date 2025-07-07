// src/ComponentShowcase.jsx
import React, { useState } from 'react';
import Button from './components/ui/Button';
import Input from './components/ui/Input';
import Textarea from './components/ui/Textarea';
import ActionButtons from './components/ui/ActionButtons';
import Pagination from './components/ui/Pagination';
import CampaignCard from './components/ui/CampaignCard';
// import './index.css'; // Biasanya index.css diimpor di main.jsx, tidak perlu di sini lagi kecuali ada styling spesifik demo

import {
  PlusIcon,
  ArrowDownTrayIcon
} from '@heroicons/react/24/solid';

// Ubah nama fungsi dari 'App' menjadi 'ComponentShowcase'
function ComponentShowcase() {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [page, setPage] = useState(1);
  const [perPage, setPerPage] = useState(10);

  const campaigns = [
    {
      image: "https://images.pexels.com/photos/8846738/pexels-photo-8846738.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260",
      title: "Test Update",
      author: "User Test Upd",
      raised: 0,
      goal: 500000,
    },
    {
      image: "https://images.pexels.com/photos/8846738/pexels-photo-8846738.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260",
      title: "Fuga recusandae omnis quam perspiciatis eaque.",
      author: "Mellie Effertz V",
      raised: 304680,
      goal: 500000,
    },
    {
      image: "https://images.pexels.com/photos/8846738/pexels-photo-8846738.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260",
      title: "Esse sunt facere ducimus et sed et.",
      author: "Duncan Block",
      raised: 455999,
      goal: 500000,
    },
  ];

  const handleClick = (buttonName) => {
    alert(`Tombol "${buttonName}" diklik!`);
  };

  const toggleDarkMode = () => {
    document.documentElement.classList.toggle('dark');
  };

  return (
    <div className="min-h-screen bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white p-8 flex flex-col items-center space-y-8">
      <h1 className="text-3xl font-bold mb-6">Contoh Penggunaan Button</h1>

      <button onClick={toggleDarkMode} className="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md mb-8">
        Toggle Dark Mode
      </button>

      {/* Buttons */}
      <div className="flex flex-wrap gap-4 justify-center bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-2xl">
        <h2 className="text-xl font-semibold w-full text-center mb-2">Primary Buttons</h2>
        <Button onClick={() => handleClick('Masuk')}>Masuk</Button>
        <Button size="lg" onClick={() => handleClick('Jelajahi Campaign')}>Jelajahi Campaign</Button>
        <Button size="sm" onClick={() => handleClick('New User')}>New User</Button>
        <Button fullWidth className="mt-4" onClick={() => handleClick('Ajukan Campaign')}>Ajukan Campaign</Button>
        <Button fullWidth onClick={() => handleClick('Daftar')}>Daftar</Button>
        {["New review", "New report", "New user", "New category", "New campaign"].map((label, i) => (
          <Button key={i} size="sm" onClick={() => handleClick(label)}>{label}</Button>
        ))}
      </div>

      {/* Buttons with Icons */}
      <div className="flex flex-wrap gap-4 justify-center bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-2xl">
        <h2 className="text-xl font-semibold w-full text-center mb-2">Primary Buttons with Icons</h2>
        <Button onClick={() => handleClick('Buat Campaign Baru')} icon={<PlusIcon className="h-5 w-5" />}>Buat Campaign Baru</Button>
        <Button onClick={() => handleClick('Export')} icon={<ArrowDownTrayIcon className="h-5 w-5" />}>Export</Button>
      </div>

      {/* Secondary, Danger, Ghost, Link, Table, Filter */}
      <div className="flex flex-wrap gap-4 justify-center bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-2xl">
        <h2 className="text-xl font-semibold w-full text-center mb-2">Secondary Buttons</h2>
        <Button variant="secondary" onClick={() => handleClick('Create & create another')}>Create & create another</Button>
        <Button variant="secondary" onClick={() => handleClick('Cancel')}>Cancel</Button>
      </div>

      <div className="flex flex-wrap gap-4 justify-center bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-2xl">
        <h2 className="text-xl font-semibold w-full text-center mb-2">Danger Buttons</h2>
        <Button variant="danger" onClick={() => handleClick('Delete Item')}>Delete Item</Button>
        <Button variant="danger" size="sm" onClick={() => handleClick('Delete')}>Delete</Button>
      </div>

      <div className="flex flex-wrap gap-4 justify-center bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-2xl">
        <h2 className="text-xl font-semibold w-full text-center mb-2">Ghost Buttons</h2>
        <Button variant="ghost" onClick={() => handleClick('Cancel')}>Cancel</Button>
        <Button variant="ghost" disabled>Disabled Ghost</Button>
      </div>

      <div className="flex flex-wrap gap-4 justify-center bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-2xl">
        <h2 className="text-xl font-semibold w-full text-center mb-2">Link Buttons</h2>
        <Button variant="link" onClick={() => handleClick('Daftar di sini')}>Daftar di sini</Button>
        <Button variant="link" disabled>Forgot Password?</Button>
        <Button variant="link" onClick={() => handleClick('Masuk sekarang')}>Masuk sekarang</Button>
      </div>

      <div className="flex flex-wrap gap-2 justify-center bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-2xl">
        <h2 className="text-xl font-semibold w-full text-center mb-2">Table Action Buttons</h2>
        {["View", "Edit", "Ubah Status", "Proses"].map((label, i) => (
          <Button key={i} variant="table" size="xs" onClick={() => handleClick(label)}>{label}</Button>
        ))}
        <Button variant="table" size="xs" disabled>Disabled</Button>
      </div>

      <div className="flex flex-wrap gap-2 justify-center bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-2xl">
        <h2 className="text-xl font-semibold w-full text-center mb-2">Filter Buttons</h2>
        <Button variant="primary" size="md" className="rounded-full" onClick={() => handleClick('Semua')}>Semua</Button>
        <Button variant="filter" size="md" onClick={() => handleClick('Biaya Pendidikan')}>Biaya Pendidikan</Button>
        <Button variant="filter" size="md" onClick={() => handleClick('Buku & Alat Belajar')}>Buku & Alat Belajar</Button>
        <Button variant="filter" size="md" disabled>Disabled Filter</Button>
      </div>

      {/* Action Buttons */}
      <div className="bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-xl">
        <h2 className="text-lg font-semibold mb-2">Action Buttons</h2>
        <ActionButtons
          onView={() => alert("Lihat data")}
          onDelete={() => alert("Hapus data")}
          onEditStatus={() => alert("Ubah status")}
          showEdit={true}
        />
      </div>

      {/* Pagination */}
      <div className="bg-gray-200 dark:bg-gray-800 p-4 rounded-md w-full max-w-xl">
        <h2 className="text-lg font-semibold mb-2">Pagination</h2>
        <Pagination
          page={page}
          totalPages={5}
          onPageChange={setPage}
          perPage={perPage}
          setPerPage={setPerPage}
        />
      </div>

      {/* Form */}
      <hr className="w-full border-gray-700 my-8" />
      <h1 className="text-3xl font-bold mb-6">Contoh Form Sederhana</h1>
      <form onSubmit={(e) => { e.preventDefault(); alert('Form submitted!'); }} className="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-xl">
        <Input label="Nama Lengkap" name="fullName" type="text" placeholder="Masukkan nama lengkap Anda" value={name} onChange={(e) => setName(e.target.value)} required />
        <Input label="Email" name="email" type="email" placeholder="Contoh: user@example.com" value={email} onChange={(e) => setEmail(e.target.value)} required />
        <Textarea label="Bio Anda" name="bio" placeholder="Ceritakan sedikit tentang diri Anda..." rows={3} />
        <Button type="submit" fullWidth className="mt-6">Submit Form</Button>
      </form>

      {/* Campaign Card Grid */}
      <hr className="w-full border-gray-700 my-8" />
      <h1 className="text-3xl font-bold mb-6">Contoh Card Campaign</h1>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full mt-10">
        {campaigns.map((data, index) => (
          <CampaignCard key={index} {...data} />
        ))}
      </div>
    </div>
  );
}

export default ComponentShowcase; 
