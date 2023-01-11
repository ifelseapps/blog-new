import React, { StrictMode } from 'react';
import ReactDOM from 'react-dom/client';
import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import MainPage from './Pages/Main';
import ReviewPage from './Pages/Review';
import ReviewsPage from './Pages/Reviews';

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
