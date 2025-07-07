import React from "react";
import clsx from 'clsx';
import { twMerge } from 'tailwind-merge';

const cn = (...args) => twMerge(clsx(...args));


const variants = {
  primary: "bg-green-600 text-white hover:bg-green-700",
  secondary: "bg-slate-600 text-white hover:bg-slate-700",
  danger: "bg-red-600 text-white hover:bg-red-700",
  ghost: "bg-transparent text-white border border-white hover:bg-white hover:text-black",
  link: "text-green-500 hover:underline",
  table: "text-sm text-white hover:underline",
  filter: "rounded-full px-3 py-1 text-sm",
};

const sizes = {
  sm: "px-3 py-1 text-sm",
  md: "px-4 py-2 text-base",
  lg: "px-5 py-3 text-lg",
  full: "w-full px-4 py-2",
};

export default function Button({
  children,
  variant = "primary",
  size = "md",
  fullWidth = false,
  icon = null,
  className = "",
  ...props
}) {
  return (
    <button
      className={cn(
        "rounded font-semibold transition-all flex items-center justify-center gap-2",
        variants[variant],
        sizes[fullWidth ? "full" : size],
        className
      )}
      {...props}
    >
      {icon && <span>{icon}</span>}
      {children}
    </button>
  );
}


