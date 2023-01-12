import React, { StrictMode } from 'react';
import ReactDOM from 'react-dom/client';
import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import MainPage from 'admin/pages/Main';
import ReviewPage from 'admin/pages/Review';
import ReviewsPage from 'admin/pages/Reviews';

const container = document.getElementById('app');
const root = ReactDOM.createRoot(container as HTMLDivElement);

const router = createBrowserRouter(
  [
    {
      path: '/',
      element: <MainPage />,
    },
    {
      path: '/reviews/',
      element: <ReviewsPage />,
    },
    {
      path: '/reviews/:id/',
      element: <ReviewPage />,
    },
  ],
  { basename: '/admin' }
);

root.render(
  <StrictMode>
    <RouterProvider router={router} />
  </StrictMode>
);
