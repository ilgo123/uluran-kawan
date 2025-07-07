// src/components/ui/ToggleSwitch.jsx
import { useState } from 'react'

export default function ToggleSwitch({ enabled: defaultEnabled = false, onToggle }) {
  const [enabled, setEnabled] = useState(defaultEnabled)

  const toggle = () => {
    setEnabled(!enabled)
    onToggle?.(!enabled)
  }

  return (
    <button
      onClick={toggle}
      className={`w-12 h-6 flex items-center rounded-full p-1 duration-300 ease-in-out ${
        enabled ? 'bg-green-500' : 'bg-gray-400'
      }`}
    >
      <div
        className={`bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ${
          enabled ? 'translate-x-6' : 'translate-x-0'
        }`}
      />
    </button>
  )
}
