<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ' . URLROOT);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            width: 90%;
            margin: 10% auto;
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        .container {
            width: 100%;
            display: flex;
            justify-content: space-evenly;
        }

        .card {
            background-color: #f0f4f4;
            width: 25%;
            margin: 1em;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 1em;
            text-align: center;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .row {
            width: 80%;
            display: inline-flex;
            justify-content: space-between;
            /* padding: 2%; */
        }

        .row>* {
            width: 50%;
            margin: 2%;
        }

        .images {
            display: none;
            padding: 1em;
            flex-wrap: wrap;
            width: 100%;
        }

        .images div {
            width: 200px;
            margin: 10px;
        }

        .images div img {
            max-height: 100%;
            max-width: 100%;
            transition: 2s ease-in-out;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 20px;
        }

        .images div img:hover {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
            cursor: pointer;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }


        /* Modal Content/Box */
        .modal-content {
            background-color: #FAFAFA;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            width: 50%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #F4511E;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #c62828;
            text-decoration: none;
            cursor: pointer;
        }

        .layout {
            display: flex;
            justify-content: space-between;
        }

        #form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%
        }

        #form>* {
            margin: 1em;
        }

        button,
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
            background-color: #47B5FF;
        }

        input[type='reset'] {
            background-color: #FFC447;
        }

        button.delete {
            background-color: #FF5E5E;
        }

        .buttons {
            display: inline-flex;
        }
    </style>
</head>

<body>
    <div class="row">
        <h2>DASHBOARD </h2>
        <button>LOGOUT <?php echo $_SESSION['username'] ?></button>
    </div>
    <div class="container">
        <div class="card add" target="add">ADD NEW IMAGE</div>
        <div class="card edit" target="edit">EDIT IMAGES</div>
    </div>

    <div class="images">

    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="layout">
                <img id="modal-image" width="300">
                <form id="form" method="POST" enctype="multipart/form-data" action="upload.php">
                    <div class="row">
                        <input type="text" name="primary" id="primary" hidden>
                    </div>
                    <div class="row">
                        <label for="name">Enter caption:</label>
                        <input type="text" name="caption" id="caption" required>
                    </div>
                    <div class="row">
                        <span id="checkbox">Set Slider Image</span><input type="checkbox" name="slider" id="slider">
                    </div>

                    <div class="buttons">
                        <input type="submit" id="upload-btn" value="UPLOAD">
                        <input type="reset" id="reset-btn" value="CLEAR">
                    </div>
                    <button class="delete">DELETE IMAGE</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        const cards = document.querySelectorAll('.card');
        const modal = document.querySelector('.modal');
        const modal_span = document.querySelector('.close');
        const modal_image = document.querySelector('#modal-image');
        const image_container = document.querySelector('.images');
        const modal_caption = document.querySelector('#caption')
        const span_checkbox = document.querySelector('#checkbox')
        const slider_checkbox = document.querySelector('#slider')
        const delete_button = modal.querySelector('.delete');
        const form = document.querySelector('#form');

        cards.forEach(card => {
            card.addEventListener('click', () => {
                let func = card.getAttribute('target');
                eval(`${func}()`);
            });
        })

        const add = () => {
            const input = document.createElement('input');



            input.id = 'fileToUpload';
            input.name = 'fileToUpload';

            input.type = 'file';
            input.setAttribute('hidden', true);
            input.click();

            form.appendChild(input);

            input.addEventListener('change', (e) => {
                const fileList = input.files;
                console.log(e);

                e.preventDefault();
                delete_button.style.display = 'none';
                modal_image.setAttribute('src', URL.createObjectURL(fileList[0]))
                URL.revokeObjectURL(fileList[0]);
                modal.style.display = 'block';

            })
        }

        const edit = () => {
            const primary = document.querySelector('#primary');

            fetch('upload.php?q=edit')
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    image_container.style.display = 'flex';
                    data.images.forEach((image, index) => {
                        let div = document.createElement('div');
                        div.classList.add('img-view');
                        let img = document.createElement('img');
                        img.src = `assets/images/${image.name}`;
                        img.setAttribute('primary', image.id);
                        let span = document.createElement('span');
                        if (image.caption == null) {
                            span.innerText = 'No caption';
                        } else {
                            span.innerText = `caption: ${image.caption}`;
                        }

                        div.appendChild(img);
                        div.appendChild(span);
                        image_container.appendChild(div);




                        img.addEventListener('click', () => {
                            if (image.location == null) {
                                span_checkbox.innerText = "Set Image as Slider Image??"
                                slider_checkbox.checked = false;
                            } else {
                                span_checkbox.innerText = "Image already a Slider Image. Remove?"
                                slider_checkbox.checked = true;

                            }
                            modal_image.setAttribute('src', `assets/images/${image.name}`)
                            primary.setAttribute('value', image.id);
                            modal_caption.value = image.caption;
                            modal.style.display = 'block';
                        })
                    })
                })
                .catch(err => console.error(err))
        }

        delete_button.addEventListener('click', (e) => {
            e.preventDefault();
            const primaryKey = form.querySelector('#primary').value

            if (confirm('Are You sure you want to delete image??')) {
                fetch('upload.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'Application/json'
                        },
                        body: JSON.stringify({
                            'primary': primaryKey
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        window.location.href = "dashboard.php";

                    })
            }
        });
        // / When the user clicks anywhere outside of the modal, close it
        window.onclick = (event) => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        modal_span.onclick = () => {
            modal.style.display = "none";
        }
    </script>
</body>

</html>