import React from 'react';

/**
 * Komponen Textarea yang reusable dengan styling Tailwind CSS.
 *
 * @param {object} props - Properti untuk komponen Textarea.
 * @param {string} [props.label] - Label teks untuk textarea.
 * @param {string} [props.id] - ID unik untuk textarea dan atribut 'for' label. Jika tidak disediakan, akan di-generate.
 * @param {string} [props.placeholder] - Teks placeholder untuk textarea.
 * @param {string} [props.value] - Nilai saat ini dari textarea (digunakan untuk controlled components).
 * @param {function} [props.onChange] - Handler fungsi yang dipanggil saat nilai textarea berubah.
 * @param {string} [props.name] - Atribut 'name' untuk textarea (penting untuk form submission).
 * @param {number} [props.rows=4] - Jumlah baris default yang terlihat untuk textarea.
 * @param {boolean} [props.required=false] - Menandai textarea sebagai wajib diisi.
 * @param {boolean} [props.disabled=false] - Jika true, textarea akan dinonaktifkan.
 * @param {string} [props.error] - Pesan error untuk ditampilkan di bawah textarea.
 * @param {string} [props.className=''] - Kelas CSS tambahan untuk styling kustom pada textarea field.
 * @param {string} [props.labelClassName=''] - Kelas CSS tambahan untuk styling kustom pada label.
 * @param {object} [props.textareaProps] - Objek untuk properti HTML standar lainnya pada elemen textarea.
 */
const Textarea = ({
  label,
  id,
  placeholder,
  value,
  onChange,
  name,
  rows = 4, // Default rows
  required = false,
  disabled = false,
  error,
  className = '',
  labelClassName = '',
  textareaProps, // Untuk properti seperti maxLength, cols, wrap, dll.
}) => {
  // Generate ID jika tidak disediakan
  const textareaId = id || (name ? `textarea-${name}` : `textarea-${Math.random().toString(36).substring(2, 9)}`);

  // Base styles untuk textarea field
  const baseTextareaStyles = `
    block w-full px-4 py-2 mt-1
    border rounded-lg
    bg-gray-800 text-gray-200
    placeholder-gray-500
    focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent
    resize-y focus:resize-y-auto
    transition-all duration-200
  `;

  // Styling untuk error state
  const errorTextareaStyles = error
    ? 'border-red-500 focus:ring-red-500'
    : 'border-gray-700';

  // Styling untuk disabled state
  const disabledTextareaStyles = disabled
    ? 'bg-gray-700 text-gray-500 cursor-not-allowed'
    : '';

  // Gabungkan semua kelas textarea
  const allTextareaClassNames = `${baseTextareaStyles} ${errorTextareaStyles} ${disabledTextareaStyles} ${className}`.trim();

  return (
    <div className="mb-4"> {/* Container untuk label, textarea, dan error */}
      {label && (
        <label
          htmlFor={textareaId}
          className={`block text-sm font-medium text-gray-300 mb-1 ${labelClassName}`}
        >
          {label}
          {required && <span className="text-red-500 ml-1">*</span>}
        </label>
      )}
      <textarea
        id={textareaId}
        name={name}
        placeholder={placeholder}
        value={value}
        onChange={onChange}
        rows={rows}
        required={required}
        disabled={disabled}
        className={allTextareaClassNames}
        {...textareaProps} // Meneruskan properti tambahan
      />
      {error && (
        <p className="mt-1 text-sm text-red-500">
          {error}
        </p>
      )}
    </div>
  );
};

export default Textarea;
