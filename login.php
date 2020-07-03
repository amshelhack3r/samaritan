<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 500px;
        }

        input[type="text"],
        input[type="password"] {
            display: block;
            border: 0;
            background: #fafafa;
            width: 80%;
            margin: 0 auto;
            border-radius: 0.5em;
            border: solid 1px #e5e5e5;
            padding: 1em;
        }

        .card {
            background-color: #f0f4f4;
            width: 25%;
            margin: 1em;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 1em;
            text-align: center;
        }

        .input {
            display: flex;
            flex-direction: column;
            justify-items: center;
            margin-top: 20px;
        }

        input[type='submit'],
        input[type='reset'] {
            width: 60%;
            padding: 14px 16px;
            margin: 5px auto;
            border-radius: 20px;
            outline: none;
            border: none;
        }

        input[type='submit'] {
            border:1px solid rgb(71, 181, 255);
            color: rgb(71, 181, 255);
            background: #fafafa;
        }

        input[type='reset'] {
            border:1px solid rgb(255, 196, 71);
            color: rgb(255, 196, 71);
            background: #fafafa;
        }

        input[type='submit']:hover{ 
            border: none;
            background-color: rgb(71, 181, 255);
            color: #fafafa;
        }

        input[type='reset']:hover{
            border: none;
            background-color: rgb(255, 196, 71);
            color: #fafafa;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>ADMIN LOGIN</h2>
        <form id="login">
            <div class="input">
                <label for="username">Enter username</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="input">
                <label for="password">Enter Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="input row">
                <input type="submit" value="login">
                <input type="reset" value="clear">
            </div>
        </form>

    </div>
    <script>
        const loginForm = document.querySelector('#login');

        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(loginForm);
            console.log(formData.get('username'));
            console.log(formData.get('password'));

            const response = fetch('admin.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    switch (data.code) {
                        case 403:
                            alert(data.message);
                            break;
                        case 500:
                            alert("SERVER ERROR")
                            break;
                        default:
                            window.location.href = "dashboard.php";
                            break;
                    }
                })

        })
    </script>
</body>

</html>