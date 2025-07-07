import React from 'react';

/**
 * Komponen Input yang reusable dengan styling Tailwind CSS.
 * Mendukung berbagai tipe input teks standar (text, email, password, number).
 *
 * @param {object} props - Properti untuk komponen Input.
 * @param {string} [props.label] - Label teks untuk input.
 * @param {string} [props.id] - ID unik untuk input dan atribut 'for' label. Jika tidak disediakan, akan di-generate.
 * @param {string} [props.type='text'] - Tipe input HTML: 'text', 'email', 'password', 'number', 'tel', 'url', dll.
 * @param {string} [props.placeholder] - Teks placeholder untuk input.
 * @param {string} [props.value] - Nilai saat ini dari input (digunakan untuk controlled components).
 * @param {function} [props.onChange] - Handler fungsi yang dipanggil saat nilai input berubah.
 * @param {string} [props.name] - Atribut 'name' untuk input (penting untuk form submission).
 * @param {boolean} [props.required=false] - Menandai input sebagai wajib diisi.
 * @param {boolean} [props.disabled=false] - Jika true, input akan dinonaktifkan.
 * @param {string} [props.error] - Pesan error untuk ditampilkan di bawah input.
 * @param {string} [props.className=''] - Kelas CSS tambahan untuk styling kustom pada input field.
 * @param {string} [props.labelClassName=''] - Kelas CSS tambahan untuk styling kustom pada label.
 * @param {object} [props.inputProps] - Objek untuk properti HTML standar lainnya pada elemen input (misal: pattern, min, max).
 */
const Input = ({
  label,
  id,
  type = 'text',
  placeholder,
  value,
  onChange,
  name,
  required = false,
  disabled = false,
  error,
  className = '',
  labelClassName = '',
  inputProps, // Untuk properti seperti pattern, min, max, dll.
}) => {
  // Generate ID jika tidak disediakan
  const inputId = id || (name ? `input-${name}` : `input-${Math.random().toString(36).substring(2, 9)}`);

  // Base styles untuk input field
  const baseInputStyles = `
    block w-full px-4 py-2 mt-1
    border rounded-lg
    bg-gray-800 text-gray-200
    placeholder-gray-500
    focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent
    transition-all duration-200
  `;

  // Styling untuk error state
  const errorInputStyles = error
    ? 'border-red-500 focus:ring-red-500'
    : 'border-gray-700';

  // Styling untuk disabled state
  const disabledInputStyles = disabled
    ? 'bg-gray-700 text-gray-500 cursor-not-allowed'
    : '';

  // Gabungkan semua kelas input
  const allInputClassNames = `${baseInputStyles} ${errorInputStyles} ${disabledInputStyles} ${className}`.trim();

  return (
    <div className="mb-4"> {/* Container untuk label, input, dan error */}
      {label && (
        <label
          htmlFor={inputId}
          className={`block text-sm font-medium text-gray-300 mb-1 ${labelClassName}`}
        >
          {label}
          {required && <span className="text-red-500 ml-1">*</span>}
        </label>
      )}
      <input
        id={inputId}
        type={type}
        name={name}
        placeholder={placeholder}
        value={value}
        onChange={onChange}
        required={required}
        disabled={disabled}
        className={allInputClassNames}
        {...inputProps} // Meneruskan properti tambahan
      />
      {error && (
        <p className="mt-1 text-sm text-red-500">
          {error}
        </p>
      )}
    </div>
  );
};

export default Input;
