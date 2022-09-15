<!-- add basic html structur -->
<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Lab 8</title>

    <script>
        let delayTimer;

        $(document).ready(function() {

            $("#ip").on("change", function() {
                handleChange();
            });
            $("#ip").on("keyup", function() {
                handleChange();
            });

            function handleChange() {
                $("#message").hide();
                delayTimer = setTimeout(function() {
                    const ip = $("#ip").val();
                    const ipRegex = /^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
                    if (!ipRegex.test(ip)) {
                        $("#message").show();
                        return;
                    }
                    $.get("handle_request.php", {
                        ip: ip
                    }, function(data) {
                        $("#result").html(data);
                        $("#ip").css("border", "");
                        $("#ip").css("background-color", "");
                        $("#ip").css("color", "");
                    });
                }, 1000);
            }
        });
    </script>
</head>

<body>
    <h1>Lab 8</h1>
    <form>
        <label for="ip">IP Address:</label>
        <input type="text" name="ip" id="ip" pattern="^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" onkeydown="handleChange(event);">
        <p id="message" style="color: red;" hidden>Invalid IP</p>
    </form>
    <div id="result"></div>
</body>

</html>