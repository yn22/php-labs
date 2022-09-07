<!DOCTYPE html>
<html>

<head>
    <script>
        let delayTimer;

        function handleKeyPress(event) {
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {
                document.querySelector(".loader").style.display = "block";
                document.getElementById("search_results").innerHTML = "";

                const searchTerm = event.target.value;
                const xhr = new XMLHttpRequest();
                xhr.open("GET", `./handle_search.php?search_term=${searchTerm}`);
                xhr.send();
                xhr.onload = function() {
                    document.getElementById("search_results").innerHTML = xhr.responseText;
                    document.querySelector(".loader").style.display = "none";
                }
                xhr.onerror = function() {
                    document.querySelector(".loader").style.display = "none";
                }

            }, 1000);
        }
    </script>
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 100px;
            height: 100px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .container {
            width: 70%;
            margin-left: 15%;
        }
    </style>
</head>

<body>
    <div class="container">
        <label>Пошук</label>
        <input type="text" id="id-search" onkeyup="handleKeyPress(event)" onchange="handleKeyPress(event)"></input>
        <div class="loader" style="display: none;"></div>

        <div id="search_results"></div>
    </div>
</body>

</html>