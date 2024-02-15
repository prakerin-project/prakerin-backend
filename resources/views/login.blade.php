<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ asset('logo.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akshar&family=Bitter&display=swap" rel="stylesheet">

    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url({{ asset('bg.png') }});
        }

        .form-cover {
            background-color: rgba(236, 247, 255, 0.75);
            position: absolute;
            top: 50%;
            left: 50%;
            color: #006FEE;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 500px;
            border-radius: 10px;
            font-family: 'Akshar', sans-serif;
        }

        .form-cover h1 {
            font-size: 50px;
            font-weight: 300;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div class="form-cover p-5 d-flex justify-content-center align-content-center flex-column">
        <h1>Login</h1>
        <form id="tambah-ps-form" class="mt-3" enctype="multipart/form-data">
            <label for="username" class="fs-5 ">Username</label>
            <input type="text" id="username" class="form-control mb-3 fs-5" autofocus name="username" />
            <label for="password" class="fs-5">Password</label>
            <input type="password" id="password" class="form-control mb-3 fs-5" name="password" />

            <div class="text-danger errors">
                <p class="err-message"></p>
            </div>
            <button class="btn btn-primary shadow px-4" type="submit">Log me in</button>

            @csrf
        </form>
    </div>
    <script type="module">
        $('#username, #password').on('input', function() {
            $('.err-message').text(""); // Clear error message when input changes
        });

        $('form').submit(async function(e) {
            e.preventDefault();
            let username = $('#username').val();
            let password = $('#password').val();

            if (!username || !password) {
                $('.err-message').append(document.createTextNode('Username or password cannot be empty!'))
                return;
            }

            await axios({
                method: 'post',
                url: '<?= config("app.url") ?>/login',
                data: {
                    username,
                    password
                }
            }).then(async () => {
                await swal.fire({
                    title: 'Login berhasil!',
                    text: 'Redirecting to dashboard...',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false
                })
                window.location = '/dashboard'
                console.log('success')
            }).catch(({
                response
            }) => {
                if (!$('.err-message').text()) {
                    $('.err-message').append(document.createTextNode(response.data.errors.message))
                }
            })
        })
    </script>
</body>

</html>
