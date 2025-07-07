// Login.
import Button from "../components/Button";
import Input from "../components/Input";
import FormCard from "../components/FormCard";
import { useState } from "react";

export default function Login() {
  const [form, setForm] = useState({ email: "", password: "" });

  return (
    <div className="min-h-screen bg-gradient-to-br from-green-100 to-teal-100 flex items-center justify-center">
      <FormCard>
        <img src="/logo.svg" alt="logo" className="mx-auto mb-2 w-10" />
        <h1 className="text-2xl font-bold text-green-700 mb-1">Uluran Kawan</h1>
        <p className="text-gray-500 mb-5 text-sm">Satu aksi kecil bisa jadi harapan besar.</p>

        <h2 className="text-lg font-semibold mb-4">Login ke Akunmu</h2>
        <Input
          label="Email"
          type="email"
          name="email"
          value={form.email}
          onChange={(e) => setForm({ ...form, email: e.target.value })}
        />
        <Input
          label="Password"
          type="password"
          name="password"
          value={form.password}
          onChange={(e) => setForm({ ...form, password: e.target.value })}
        />

        <Button type="submit">Masuk</Button>

        <p className="text-sm mt-4 text-gray-500">
          Belum punya akun? <a href="/register" className="text-green-600 hover:underline">Daftar di sini</a>
        </p>
      </FormCard>
    </div>
  );
}
