<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خوش آمدید</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/v5.0.2/Vazir.css" type="text/css">
    <style>
        body {
            text-align: right;
            background-color: #1876f2;
            background-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.6) 35%, rgba(0, 0, 0, 0.8) 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Vazirmatn;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .btn {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <img src="{{ asset('storage/images/logo.png') }}" alt="logo-img" style="margin-bottom: 20px;">
                <p class="lead text-center">جایی که دوستداران کتاب جمع می‌شوند و ایده‌ها را به اشتراک می‌گذارند</p>
                <div class="text-center">
                    <a href="/register" class="btn btn-primary">ثبت نام</a>
                    <a href="/login" class="btn btn-secondary mr-2">ورود</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>