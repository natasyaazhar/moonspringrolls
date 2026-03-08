<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f6f8fb;
            padding: 20px;
        }
        .card {
            background: white;
            max-width: 500px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .header {
            background: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 25px;
            color: #333;
        }
        .status {
            background: #e7f1ff;
            padding: 10px;
            border-radius: 5px;
            margin: 15px 0;
            font-weight: bold;
            color: #0d6efd;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            padding: 15px;
        }
        .button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 18px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="header">
            <h2>📦 Delivery Update</h2>
        </div>

        <div class="content">
            <p>Hello <strong>{{ $parcel->name }}</strong>,</p>
            <p>Good news! Your order from our homemade popia kitchen is currently:</p>
            <div class="status">

                🚚 Out For Delivery

            </div>
            <p>Our rider is on the way and your parcel should arrive soon at your doorstep.</p>
            <p>Thank you for supporting our small home business ❤️</p>
            <a class="button">

                Enjoy your popia!

            </a>

        </div>
        <div class="footer">

            Moon Spring Rolls Kitchen
            Freshly made with love 🌯

        </div>
    </div>
</body>
</html>