<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Preview</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html,
        body {
            height: 100%;
        }

        /* Ukuran asli perangkat */
        :root {
            --device-width: 450px;
            --device-height: 844px;
            --scale: 0.7;
            /* 🔥 Sesuaikan jika ingin lebih kecil/besar */
        }

        .device-wrapper {
            height: calc(var(--device-height) * var(--scale));
            display: flex;
            align-items: flex-start;
            justify-content: center;
            /* padding-top: 20px; */
            /* 🔥 FIX TERPOTONG ATAS */
        }

        .device-frame {
            width: var(--device-width);
            height: var(--device-height);
            /* border-radius: 28px; */
            /* border: 1px solid #e5e7eb; */
            /* box-shadow:
                0 20px 40px rgba(2, 6, 23, 0.12),
                inset 0 1px 0 rgba(255, 255, 255, 0.3); */
            overflow: hidden;
            transform: scale(var(--scale));
            transform-origin: top center;
            background: white;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body class="bg-black flex items-center justify-center min-h-screen p-6">

    <div class="device-wrapper">
        <div class="device-frame">
            <iframe src="/"></iframe>
        </div>
    </div>

</body>

</html>
