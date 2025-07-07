// src/main.jsx
import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

import App from './App';
import ExploreCampaign from './pages/ExploreCampaign';
import ComponentShowcase from './ComponentShowcase';
import './index.css';

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<App />} /> {/* Landing Page */}
        <Route path="/explore" element={<ExploreCampaign />} />
        <Route path="/component-showcase" element={<ComponentShowcase />} /> {/* Rute untuk demo komponen */}
      </Routes>
    </BrowserRouter>
  </React.StrictMode>,
);
