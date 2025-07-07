import React from 'react';

export default function CampaignCard({ image, title, author, raised, goal }) {
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(number);
    };

    const progressPercentage = (raised / goal) * 100;

    return (
        <div className="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 border border-gray-100">
            <img
                src={image || "https://via.placeholder.com/400x250?text=Campaign+Image"}
                alt={title}
                className="w-full h-36 md:h-40 object-cover"
            />
            <div className="p-3 md:p-4">
                <h3 className="font-semibold text-base md:text-lg text-gray-800 mb-1 md:mb-2 truncate"> {/* Sesuaikan ukuran font */}
                    {title}
                </h3>
                <p className="text-xs md:text-sm text-gray-600 mb-3"> {/* Sesuaikan ukuran font dan margin */}
                    oleh {author}
                </p>
                <div className="mb-3"> {/* Kurangi margin */}
                    <div className="flex justify-between text-xs font-medium text-gray-700 mb-1"> {/* Sesuaikan ukuran font */}
                        <span>{formatRupiah(raised)}</span>
                        <span>terkumpul dari {formatRupiah(goal)}</span>
                    </div>
                    <div className="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700"> {/* Kurangi tinggi progress bar */}
                        <div
                            className="bg-green-700 h-2 rounded-full"
                            style={{ width: `${Math.min(progressPercentage, 100)}%` }}
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    );
}
