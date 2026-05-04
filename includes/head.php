<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo isset($pageTitle) ? $pageTitle . " - AskMe Tour and Travel" : "AskMe Tour and Travel"; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="assets/img/askme.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#89C23D',    /* Logo Green */
                        secondary: '#1D609E',  /* Logo Blue */
                        vibrant: '#46B89D',    /* Logo Teal */
                        dark: '#0f172a',
                        light: '#f8fafc'
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    boxShadow: {
                        'subtle': '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)',
                        'premium': '0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)',
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --primary: #7AB730;
            --primary-vibrant: #88e01b;
        }
        body { 
            font-family: 'Outfit', sans-serif; 
            scroll-behavior: smooth;
            background-color: #f8fafc;
        }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .glass-dark {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .btn-futuristic {
            @apply relative overflow-hidden transition-all duration-300;
        }
        .btn-futuristic::after {
            content: '';
            @apply absolute inset-0 bg-white/20 translate-x-[-100%] transition-transform duration-500;
        }
        .btn-futuristic:hover::after {
            @apply translate-x-[100%];
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { 
            background: #cbd5e1; 
            border-radius: 5px;
            border: 2px solid #f1f5f9;
        }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .hover-lift:hover {
            transform: translateY(-8px);
        }
        section {
            scroll-margin-top: 100px;
        }
    </style>
</head>

<body>