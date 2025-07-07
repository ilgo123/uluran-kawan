// src/components/ui/ActionButtons.jsx
import { Eye, Trash2, Pencil } from 'lucide-react';

const ActionButtons = ({ onView, onDelete, onEditStatus, showEdit = false }) => {
  return (
    <div className="flex items-center gap-3">
      <button
        onClick={onView}
        className="text-sm text-gray-100 hover:text-green-400 flex items-center gap-1"
      >
        <Eye size={16} />
        View
      </button>

      {showEdit && (
        <button
          onClick={onEditStatus}
          className="text-sm text-green-400 hover:underline flex items-center gap-1"
        >
          <Pencil size={16} />
          Ubah Status
        </button>
      )}

      <button
        onClick={onDelete}
        className="text-sm text-red-500 hover:underline flex items-center gap-1"
      >
        <Trash2 size={16} />
        Delete
      </button>
    </div>
  );
};

export default ActionButtons;
