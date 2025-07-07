// src/components/ui/Pagination.jsx
import { ChevronLeft, ChevronRight } from 'lucide-react';

const Pagination = ({ page, totalPages, onPageChange, perPage, setPerPage }) => {
  return (
    <div className="flex justify-between items-center text-sm mt-6">
      <div className="flex items-center gap-2">
        <span>Per page</span>
        <select
          value={perPage}
          onChange={(e) => setPerPage(parseInt(e.target.value))}
          className="bg-zinc-800 border border-zinc-700 rounded px-2 py-1 text-white"
        >
          {[5, 10, 20, 50].map((num) => (
            <option key={num} value={num}>
              {num}
            </option>
          ))}
        </select>
      </div>

      <div className="flex items-center gap-1">
        <button
          disabled={page <= 1}
          onClick={() => onPageChange(page - 1)}
          className="px-2 py-1 text-white bg-zinc-800 rounded disabled:opacity-40"
        >
          <ChevronLeft size={16} />
        </button>

        {[...Array(totalPages)].map((_, i) => (
          <button
            key={i}
            onClick={() => onPageChange(i + 1)}
            className={`px-3 py-1 rounded ${
              page === i + 1 ? "bg-green-600 text-white" : "bg-zinc-700 text-gray-300"
            }`}
          >
            {i + 1}
          </button>
        ))}

        <button
          disabled={page >= totalPages}
          onClick={() => onPageChange(page + 1)}
          className="px-2 py-1 text-white bg-zinc-800 rounded disabled:opacity-40"
        >
          <ChevronRight size={16} />
        </button>
      </div>
    </div>
  );
};

export default Pagination;
